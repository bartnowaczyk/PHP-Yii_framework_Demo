<?php

/**
 * This is the model class for table "Propozycja".
 *
 * The followings are the available columns in table 'Propozycja':
 * @property integer $id
 * @property integer $glosowanieId
 * @property integer $autorId
 * @property string $opis
 * @property string $urlGaleria
 *
 * The followings are the available model relations:
 * @property GlosPropozycja[] $glosPropozycjas
 * @property Autor $autor
 * @property User $user
 * @property Glosowanie $glosowanie
 */
class Propozycja extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Propozycja the static model class
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
		return 'Propozycja';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('glosowanieId, autorId, userId, opis, urlGaleria', 'required'),
			array('glosowanieId, autorId userId', 'numerical', 'integerOnly'=>true),
			array('urlGaleria', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, glosowanieId, autorId, userId, opis, urlGaleria', 'safe', 'on'=>'search'),
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
			'glosy' => array(self::MANY_MANY, 'Glos', 'GlosPropozycja(glosId, propozycjaId)'),
			'autor' => array(self::BELONGS_TO, 'Autor', 'autorId'),
			'user' => array(self::BELONGS_TO, 'user', 'userId'),
			'glosowanie' => array(self::BELONGS_TO, 'Glosowanie', 'glosowanieId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'glosowanieId' => 'Glosowanie',
			'autorId' => 'Autor',
			'userId' => 'Dodane przez:',
			'opis' => 'Opis',
			'urlGaleria' => 'Url Galeria',
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
		$criteria->compare('autorId',$this->autorId);
		$criteria->compare('opis',$this->opis,true);
		$criteria->compare('urlGaleria',$this->urlGaleria,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
