	<?php

/**
 * This is the model class for table "Komisja".
 *
 * The followings are the available columns in table 'Komisja':
 * @property integer $id
 * @property string $nazwa
 * @property integer $adresId
 * @property integer $radaId
 *
 * The followings are the available model relations:
 * @property Glos[] $gloses
 * @property Adres $adres
 * @property Rada $rada
 * @property KomisjaUser[] $czlonkowie
 */
class Komisja extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Komisja the static model class
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
		return 'Komisja';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nazwa, radaId', 'required', 'message'=>'	Wartość zmiennej {attribute} jest wymagana.'),
			array('adresId, radaId', 'numerical', 'integerOnly'=>true),
			array('nazwa', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nazwa, adresId, radaId', 'safe', 'on'=>'search'),
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
			'gloses' => array(self::HAS_MANY, 'Glos', 'komisjaId'),
			'adres' => array(self::BELONGS_TO, 'Adres', 'adresId'),
			'rada' => array(self::BELONGS_TO, 'Rada', 'radaId'),
			'czlonkowie' => array(self::MANY_MANY, 'User', 'UserKomisja(komisjaId, userId)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Wybierz',
			'nazwa' => 'Nazwa',
			'adresId' => 'Adres',
			'radaId' => 'Rada',
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
		$criteria->compare('adresId',$this->adresId);
		$criteria->compare('radaId',$this->radaId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getPowiazaniLudzie() {
			$out=CHtml::listData($this->czlonkowie,'id','fullName');
			if(count($out)>0){
				$ausgabe = '<ul>';
				foreach($out as $key=>$value) { 
					$ausgabe .= sprintf('<li> %s</li>', $value);
				}
				$ausgabe .= '</ul>';
				return $ausgabe;
			}
			else {
				return "Brak członków";
			}
	}

}
