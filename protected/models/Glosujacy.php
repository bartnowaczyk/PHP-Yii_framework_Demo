<?php

/**
 * This is the model class for table "Glosujacy".
 *
 * The followings are the available columns in table 'Glosujacy':
 * @property integer $id
 * @property string $imie
 * @property string $nazwisko
 * @property string $pesel
 * @property string $nrDokumentu
 *
 * The followings are the available model relations:
 * @property Glos[] $gloses
 */
class Glosujacy extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Glosujacy the static model class
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
		return 'Glosujacy';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('imie', 'length', 'max'=>50),
			array('nazwisko', 'length', 'max'=>150),
			array('pesel', 'length', 'max'=>11),
			array('nrDokumentu', 'length', 'max'=>25),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, imie, nazwisko, pesel, nrDokumentu', 'safe', 'on'=>'search'),
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
			'gloses' => array(self::HAS_MANY, 'Glos', 'glosujacyId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'imie' => 'Imie',
			'nazwisko' => 'Nazwisko',
			'pesel' => 'Pesel',
			'nrDokumentu' => 'Nr Dokumentu',
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
		$criteria->compare('imie',$this->imie,true);
		$criteria->compare('nazwisko',$this->nazwisko,true);
		$criteria->compare('pesel',$this->pesel,true);
		$criteria->compare('nrDokumentu',$this->nrDokumentu,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function zmien() {
			if(!$this->imie)
				$this->imie='00011110';
			if(!$this->nazwisko)
				$this->nazwisko='00011110';
			if(!$this->pesel)
				$this->pesel='00011110';
			if(!$this->nrDokumentu)
				$this->nrDokumentu='00011110';
		
	}
}
