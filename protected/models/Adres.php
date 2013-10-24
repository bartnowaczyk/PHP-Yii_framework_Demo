<?php

/**
 * This is the model class for table "Adres".
 *
 * The followings are the available columns in table 'Adres':
 * @property integer $id
 * @property string $miejscowosc
 * @property string $ulica
 * @property string $dom
 * @property string $lokal
 *
 * The followings are the available model relations:
 * @property Komisje[] $komisje
 * @property Rady[] $rady
 */
class Adres extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Adres the static model class
	 */
	 
	 private $fullAddress; 
	 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Adres';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('miejscowosc, dom', 'required', 'message'=>'	Wartość zmiennej {attribute} jest wymagana.'),
			array('miejscowosc, ulica', 'length', 'max'=>50, 'message'=>'Maksymalna długość wpisu to 50 znaków.'),
			array('dom, lokal', 'length', 'max'=>10, 'message'=>'Maksymalna długość wpisu to 10 znaków.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, miejscowosc, ulica, dom, lokal', 'safe', 'on'=>'search'),
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
			'komisje' => array(self::HAS_MANY, 'Komisja', 'adresId'),
			'rady' => array(self::HAS_MANY, 'Rada', 'adresId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'miejscowosc' => 'Miejscowość',
			'ulica' => 'Ulica',
			'dom' => 'Dom',
			'lokal' => 'Nr lokalu',
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
		$criteria->compare('miejscowosc',$this->miejscowosc,true);
		$criteria->compare('ulica',$this->ulica,true);
		$criteria->compare('dom',$this->dom,true);
		$criteria->compare('lokal',$this->lokal,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getFullAddress() {
		return $this->miejscowosc . ', ul. ' . $this->ulica . " " . $this->dom . "/" . $this->lokal ;
	}
}
