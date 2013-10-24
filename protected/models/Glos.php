<?php

/**
 * This is the model class for table "Glos".
 *
 * The followings are the available columns in table 'Glos':
 * @property integer $id
 * @property integer $glosowanieId
 * @property integer $glosujacyId
 * @property integer $komisjaId
 * @property string $data
 * @property integer $userId
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Glosowanie $glosowanie
 * @property Glosujacy $glosujacy
 * @property Komisja $komisja
 * @property Propozycje[] $Propozycje
 */
class Glos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Glos the static model class
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
		return 'Glos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('glosowanieId, glosujacyId, komisjaId, userId', 'numerical', 'integerOnly'=>true),
			array('id, glosowanieId, glosujacyId, komisjaId, data, userId', 'safe', 'on'=>'search'),
			
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
			'user' => array(self::BELONGS_TO, 'User', 'userId'),
			'glosowanie' => array(self::BELONGS_TO, 'Glosowanie', 'glosowanieId'),
			'glosujacy' => array(self::BELONGS_TO, 'Glosujacy', 'glosujacyId'),
			'komisja' => array(self::BELONGS_TO, 'Komisja', 'komisjaId'),
			'propozycje' => array(self::MANY_MANY, 'Propozycja', 'GlosPropozycja(glosId, propozycjaId)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'glosowanieId' => 'Głosowanie',
			'glosujacyId' => 'Głosujacy',
			'komisjaId' => 'Komisja',
			'data' => 'Data oddania głosu',
			'userId' => 'Członek Komisji',
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
		$criteria->compare('glosowanieId',$this->glosowanieId);
		$criteria->compare('glosujacyId',$this->glosujacyId);
		$criteria->compare('komisjaId',$this->komisjaId);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('userId',$this->userId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
