<?php

/**
 * This is the model class for table "Settings".
 *
 * The followings are the available columns in table 'Settings':
 * @property integer $id
 * @property integer $czyPesel
 * @property integer $ilePesel
 * @property integer $czyImie
 * @property integer $czyNazwisko
 * @property integer $czyDokument
 *
 * The followings are the available model relations:
 * @property Glosowanie[] $glosowania
 * @property Rada[] $rada
 */
class Settings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Settings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('czyPesel, ilePesel, czyImie, czyNazwisko, czyDokument', 'numerical', 'integerOnly'=>true),
			array('ilePesel', 'numerical','max'=>11, 'message'=>'Maksymalna długość wpisu to 11 znaków.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, czyPesel, ilePesel, czyImie, czyNazwisko, czyDokument', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'glosowania' => array(self::BELONGS_TO, 'Glosowanie', 'id'),
			'rada' => array(self::BELONGS_TO, 'Rada', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'czyPesel' => 'Sprawdzać PESEL?',
			'ilePesel' => 'Ile cyfr w numerze PESEL',
			'czyImie' => 'Sprawdzać imię?',
			'czyNazwisko' => 'Sprawdzać nazwisko?',
			'czyDokument' => 'Sprawdzać dodatkowy dokument?',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('czyPesel',$this->czyPesel);
		$criteria->compare('ilePesel',$this->ilePesel);
		$criteria->compare('czyImie',$this->czyImie);
		$criteria->compare('czyNazwisko',$this->czyNazwisko);
		$criteria->compare('czyDokument',$this->czyDokument);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function returnPesel()	
		{
		switch($this->czyPesel){
			case 0: return "Nie";
			case 1: return "Tak";
		}	
	}
	public function returnImie()	
		{
		switch($this->czyImie){
			case 0: return "Nie";
			case 1: return "Tak";
		}	
	}
	public function returnNazwisko()	
		{
		switch($this->czyNazwisko){
			case 0: return "Nie";
			case 1: return "Tak";
		}	
	}
	public function returnDokument()	
		{
		switch($this->czyDokument){
			case 0: return "Nie";
			case 1: return "Tak";
		}	
	}
}
