<?php

//'SImageUploadBehavior' => array(
//    'class' => 'ext.SImageUploadBehavior.SImageUploadBehavior',
//    'fileAttribute' => 'image',
//    'nameAttribute' => 'name',
//    'imagesRequired'=>array(
//        //'width'=>150,'height'=>200,'folder'=>'uploads', //В качестве примера, если нужно всего одно изображение
//        'thumb' => array('width'=>150,'height'=>200,'folder'=>'uploads/1'),
//        'middle' => array('width'=>400,'height'=>250,'folder'=>'uploads/2'),
//        'big' => array('width'=>900,'height'=>600,'folder'=>'uploads/3','smartResize'=>false),
//        'full' => array('resize'=>false,'folder'=>'uploads/4'),
//        ),
//)


//fileAttribute - Атрибут файла в модели, поле файла в форме должно быть с этим именем
//nameAttribute - Опционально, если хотите, что бы у файлов были осмысленные имена. В данном случае используется поле name. Например, если это значение "Новая запись" именем файла будет 25Mar2011_15-45-20novaya_zapis.jpg
//imagesRequired - самое интересное. Количество массивов определяет кол-во копий изображения. Если это просто перечень параметров будет создано 1 изображение. Допустимые параметры:
//-width - ширина изображения, обязательный параметр, нет значения по умолчанию
//-height - высота изображения, обязательный параметр, нет значения по умолчанию
//-folder - папка для загрузки относительно корня приложения, обязательный параметр, нет значения по умолчанию
//-smartResize - флаг, определяющий нужно ли полностью заполнить область изображения, по умолчанию true! Если высота или ширина исходника меньше требуемого изображения, изменений размера не будет.
//-resize - флаг, определяющий нужно ли вообще проводить манипуляции с изображением, по умолчанию true. Если false- просто копия оригинального изображения.


class SImageUploadBehavior extends CActiveRecordBehavior {

	public $fileAttribute;
	public $nameAttribute;
	public $folder = 'uploads';
	public $mkdir = true;
	public $useDateForName = true;

	public $useUrlForName = false;

	public $imagesRequired;

	private $_oldFileName;
	private $_new = false;


	public function beforeSave($event)
	{
		if(!$this->fileAttribute)
        {
			throw new CHttpException(500,Yii::t('yiiext','""fileAttribute" should be set!'));
		}
		if(!$this->imagesRequired)
        {
			throw new CHttpException(500,Yii::t('yiiext','"imagesRequired" should be set!'));
		}
        
        $model = $this->getOwner();		
		$file = CUploadedFile::getInstance($model, $this->fileAttribute);
		$fileAttribute = $this->fileAttribute;
        
        if($model->scenario==="deletePhoto")
        {
            $this->deleteImages();
            $model->uimage = "";
            return;
        }

		// if file had not benn upload then value shuld not be updated
		if(is_null($file))
        {
			unset($model->uimage);
			$this->getOwner()->{$this->fileAttribute} = $this->_oldFileName;
			return;
		}
        elseif(!$model->isNewRecord && !empty($model->$fileAttribute))
        {
			$this->deleteImages();
		}

		// new name image
		if($this->nameAttribute)
        {
			$nameAttribute = $this->nameAttribute;
			//Дата наслучай, если такое имя уже есть
			$fileName =	$this->safeFileName($nameAttribute).'.'.strtolower($file->getExtensionName());
			$fileName = $this->useDateForName
				? substr(md5(microtime()),0,20).$fileName
				: $fileName;
		}
        else
        {
			$fileName = $this->safeFileName(basename($file->getName(),'.'.$file->getExtensionName())).'.'.strtolower($file->getExtensionName());
			$fileName = $this->useDateForName
				? substr(md5(microtime()),0,20).$fileName
				: $fileName;
		}

		Yii::import('application.helpers.CArray');
		Yii::import('ext.image.Image');

		if(!is_array(reset($this->imagesRequired)))
        {
			$this->imagesRequired['fileName'] = $fileName;
			$this->manipulate($file, $this->imagesRequired);
		}
		else
        {
			foreach($this->imagesRequired as $imageRequired)
            {
				$imageRequired['fileName'] = $fileName;
				$this->manipulate($file, $imageRequired);
			}
		}

		$this->_new = true;

		$model->$fileAttribute = $fileName;
		$model->$fileAttribute = $this->useUrlForName
			? $this->getImageUrl(NULL, true)
			: $fileName;

	}
	// get absolute path to image
	private function getAbsolutePath($folder, $fileName = null)
    {
		return
		Yii::app()->basePath.'/../'.	//Путь к корню приложения
		$this->folder.'/'.
		$folder.'/'.	//Папка из конфигурации
		$fileName;
	}

	// get url for image
	public function getImageUrl($image = null,$abs = false)
    {
		$model = $this->getOwner();
		if($this->useUrlForName && !$this->_new)
			return $model->{$this->fileAttribute};

		if(!is_array(reset($this->imagesRequired)))
        {
			$folder = $this->imagesRequired['folder'];
		}
        else
        {
			if(!$image) return;
			$folder = $this->imagesRequired[$image]['folder'];
		}
		if($folder) $folder .= '/';

		$fileAttribute = $this->fileAttribute;
		$folder = '/'.$this->folder.'/'.$folder.$model->$fileAttribute;
		return $abs ? Yii::app()->baseUrl.$folder : $folder;
	}


	// delete all copy of current images of model
	public function deleteImages()
    {
		$fileAttribute = $this->fileAttribute;
		$model = $this->getOwner();

		if(!is_array(reset($this->imagesRequired)))
        {
			$imagePath = $this->getAbsolutePath($this->imagesRequired['folder'], $model->$fileAttribute);
			if(file_exists($imagePath)) unlink($imagePath);
		}
		else
        {
			foreach($this->imagesRequired as $imageRequired)
            {
				$imagePath = $this->getAbsolutePath($imageRequired['folder'], $model->$fileAttribute);
				if(file_exists($imagePath) && !is_dir($imagePath))
					unlink($imagePath);
			}
		}
	}

	// create image based on options
	private function manipulate($file, $options)
    {
		// validate options
		$this->validateOptions($options);

		$targetFolder = $options['folder'];
		$fileName = $options['fileName'];

		// path for new image
		$path = $this->getAbsolutePath($targetFolder ,$fileName);

		if($this->mkdir && !file_exists(dirname($path)))
			mkdir(dirname($path), 0777, true);

		// image copy if should not be resized
		if(isset($options['resize']) && !$options['resize'])
        {
			copy($file->getTempName(), $path);
			return;
		}

		// width and hight for new image
		$targetWidth = $options['width'];
		$targetHeight = $options['height'];
		// width and hight of uploaded image
		list($uploadedWidth, $uploadedHeight) = getimagesize($file->getTempName());

		// image copy if should not be resized
		if(isset($options['smartResize']) && !$options['smartResize'])
        {
			// if needed image more than uploaded image then nothing change
			if($targetWidth>$uploadedWidth && $targetHeight>$uploadedHeight)
            {
				copy($file->getTempName(), $path);
			}
            else
            {
				// get image for manipulate from temp folder
				$image = new Image($file->getTempName());
				// manipulate
				$image->resize($targetWidth, $targetHeight, Image::AUTO)->sharpen(1)->quality(95)->save($path);
			}
			return;
		}

		// relation of side uploaded and new image
		$uploadedRatio = $uploadedWidth/$uploadedHeight;
		$targetRatio = $targetWidth/$targetHeight;

        // compare the relation and calculate coordinates for clipping
		if($uploadedRatio>$targetRatio)
        {
			$cropHeight	= $uploadedHeight;
			$cropWidth	= $uploadedHeight*$targetRatio;
			$cropLeft	= ($uploadedWidth - $uploadedHeight*$targetRatio)*0.5;
			$cropTop	= 0;
		}
		else
        {
			$cropHeight	= $uploadedWidth/$targetRatio;
			$cropWidth	= $uploadedWidth;
			$cropLeft	= 0;
			$cropTop	= ($uploadedHeight - $uploadedWidth/$targetRatio)*0.2;
		}
		// get image for manipulate from temp folder
		$image = new Image($file->getTempName());
		// manipulate
		$image->crop($cropWidth, $cropHeight, $cropTop, $cropLeft)
				->resize($targetWidth, $targetHeight, Image::NONE)
				->sharpen(1)->quality(95)->save($path);
	}

	public function beforeDelete()
    {
		$this->deleteImages();
	}

	// validate the options of new image
	private function validateOptions($options)
    {
		if(!is_array($options))
			throw new CHttpException(500,Yii::t('yiiext','Configuration of image should be array'));
		
        if(!isset($options['folder']))
			throw new CHttpException(500,Yii::t('yiiext','Folder for upload is not set'));
		
        if(isset($options['resize']) && $options['resize']===false) return;
		
        if(!isset($options['width']) || !isset($options['height']))
			throw new CHttpException(500,Yii::t('yiiext','Wrong settings for images'));
	}

	// safe file name for new image
	private function safeFileName($string)
    {
		$converter = array(
			'а' => 'a',   'б' => 'b',   'в' => 'v',
			'г' => 'g',   'д' => 'd',   'е' => 'e',
			'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
			'и' => 'i',   'й' => 'y',   'к' => 'k',
			'л' => 'l',   'м' => 'm',   'н' => 'n',
			'о' => 'o',   'п' => 'p',   'р' => 'r',
			'с' => 's',   'т' => 't',   'у' => 'u',
			'ф' => 'f',   'х' => 'h',   'ц' => 'c',
			'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
			'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
			'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

			'А' => 'A',   'Б' => 'B',   'В' => 'V',
			'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
			'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
			'И' => 'I',   'Й' => 'Y',   'К' => 'K',
			'Л' => 'L',   'М' => 'M',   'Н' => 'N',
			'О' => 'O',   'П' => 'P',   'Р' => 'R',
			'С' => 'S',   'Т' => 'T',   'У' => 'U',
			'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
			'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
			'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
			'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
		);
		$str = strtr($string, $converter);
		$str = strtolower($str);
		$str = preg_replace('~[^-a-z0-9_]+~u', '_', $str);
		$str = trim($str, "-");

		return $str;
	}

	public function afterFind($event)
	{
		$this->_oldFileName = $this->getOwner()->{$this->fileAttribute};
	}
}
