<?php

/**
 * This is the model class for table "Rada".
 *
 * The followings are the available columns in table 'Rada':
 * @property integer $id
 * @property string $nazwa
 * @property string $gmina
 * @property string $imageUrl
 * @property integer $adresId
 * @property string $dodatkoweInfo
 * @property integer $settingsId
 *
 * The followings are the available model relations:
 * @property User[] $czlonkowie
 * @property Zgloszenia[] $zgloszenia
 * @property Glosowanie[] $glosowania
 * @property Komisja[] $komisje
 * @property Adres $adres
 * @property Settings $settingsId
 
 */
class Rada extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rada the static model class
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
		return 'Rada';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nazwa, gmina', 'required', 'message'=>'	Wartość zmiennej {attribute} jest wymagana.'),
			array('adresId, settingsId', 'numerical', 'integerOnly'=>true),
			array('nazwa', 'length', 'max'=>120),
			array('gmina', 'length', 'max'=>100),
			array('imageUrl', 'length', 'max'=>200),
			array('dodatkoweInfo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nazwa, gmina, imageUrl, adresId, settingsId, dodatkoweInfo', 'safe', 'on'=>'search'),
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
			'zgloszenia' => array(self::HAS_MANY, 'User', 'afiliacjaRadaId'),
			'czlonkowie' => array(self::HAS_MANY, 'User', 'rada_id'),
			'glosowania' => array(self::HAS_MANY, 'Glosowanie', 'radaId'),
			'komisje' => array(self::HAS_MANY, 'Komisja', 'radaId'),
			'adres' => array(self::BELONGS_TO, 'Adres', 'adresId'),
			'settings' => array(self::BELONGS_TO, 'Settings', 'settingsId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nazwa' => 'Nazwa',
			'gmina' => 'Gmina',
			'imageUrl' => 'Image Url',
			'adresId' => 'Siedziba rady',
			'settingsId' => 'Domyślne ustawienia',
			'dodatkoweInfo' => 'Dodatkowe Info',
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
		$criteria->compare('nazwa',$this->nazwa,true);
		$criteria->compare('gmina',$this->gmina,true);
		$criteria->compare('imageUrl',$this->imageUrl,true);
		$criteria->compare('adresId',$this->adresId);
		$criteria->compare('settingsId',$this->settingsId);
		$criteria->compare('dodatkoweInfo',$this->dodatkoweInfo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getPowiazaneKomisje() {
		  $out=CHtml::listData($this->komisje,'id','nazwa');
           $ausgabe = '<ul>';
           foreach($out as $key=>$value) { 
                $ausgabe .= sprintf('<li>%s</li>', CHtml::link($value, array('komisja/view', 'id' => $key)));
           }
           $ausgabe .= '</ul>';
           return $ausgabe;
	}
	public function getPowiazaniLudzie() {
		  $out=CHtml::listData($this->czlonkowie,'id','imie');
           $ausgabe = '<ul>';
           foreach($out as $key=>$value) { 
                $ausgabe .= sprintf('<li>%s</li>', CHtml::link($value, array('user/view', 'id' => $key)));
           }
           $ausgabe .= '</ul>';
           return $ausgabe;
	}

	public function getPowiazaneGlosowania() {
		  $out=CHtml::listData($this->glosowania,'id','nazwa');
           $ausgabe = '<ul>';
           foreach($out as $key=>$value) { 
                $ausgabe .= sprintf('<li>%s</li>', CHtml::link($value, array('glosowanie/view', 'id' => $key)));
           }
           $ausgabe .= '</ul>';
           return $ausgabe;
	}

	public function getZgloszenia() {
		  $out=CHtml::listData($this->zgloszenia,'id','imie');
           $ausgabe = '<ul>';
           foreach($out as $key=>$value) { 
                $ausgabe .= sprintf('<li>%s</li>', CHtml::link($value, array('glosowanie/view', 'id' => $key)));
           }
           $ausgabe .= '</ul>';
           return $ausgabe;
	}


}
