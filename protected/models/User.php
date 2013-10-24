<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property integer $id
 * @property string $login
 * @property string $haslo
 * @property string $imie
 * @property string $nazwisko
 * @property string $email
 * @property integer $rada_id
 * @property integer $rola
 *
 * The followings are the available model relations:
 * @property Glos[] $glosy
 * @property Propozycja[] $propozycje
 * @property Rada $rada
 * @property akcesRada $akcesRada
 * @property Komisja[] $komisje
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */

	public $initialPasswd, $newHaslo;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'User';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, imie, nazwisko, rola', 'required', 'message'=>'Wartość zmiennej {attribute} jest wymagana.'),
			array('haslo,', 'required', 'on'=>'insert', 'message'=>'Wartość zmiennej {attribute} jest wymagana.'),
			array('rada_id, rola', 'numerical', 'integerOnly'=>true),
			array('login, nazwisko', 'length', 'max'=>50),
			array('haslo, email', 'length', 'max'=>100),
			array('email', 'email'),
			array('login, email', 'unique'),	
			array('imie', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, login, haslo, imie, nazwisko, email, rada_id, afiliacjaRadaId, rola', 'safe', 'on'=>'search'),
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
			'glosy' => array(self::HAS_MANY, 'Glos', 'userId'),
			'propozycje' => array(self::HAS_MANY, 'Propozycja', 'userId'),
			'rada' => array(self::BELONGS_TO, 'Rada', 'rada_id'),
			'akcesRada' => array(self::BELONGS_TO, 'Rada', 'afiliacjaRadaId'),
			'komisje' => array(self::MANY_MANY, 'Komisja', 'UserKomisja(userId, komisjaId)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Login',
			'haslo' => 'Haslo',
			'imie' => 'Imie',
			'nazwisko' => 'Nazwisko',
			'email' => 'Email',
			'rada_id' => 'Rada',
			'rola' => 'Rola',
			'initialPasswd' => 'Dotychczasowe hasło',
			'newHaslo' => 'Nowe hasło',
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
		$criteria->compare('login',$this->login,true);
		$criteria->compare('haslo',$this->haslo,true);
		$criteria->compare('imie',$this->imie,true);
		$criteria->compare('nazwisko',$this->nazwisko,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('rada_id',$this->rada_id);
		$criteria->compare('rola',$this->rola);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave()
       {
			if ($this->isNewRecord){
				$pass = crypt($this->haslo, self::blowfishSalt());
//				$pass = md5(md5($this->haslo).Yii::app()->params["bbb"]);
//				$pass = md5($this->haslo);
				$this->haslo = $pass;
			}
			return true;
		}
	
	public function getFullName()
		{
		return $this->imie . " " . $this->nazwisko;
		}	
		
	public function returnRole()	
		{
		switch($this->rola){
			case 1: return "Administrator Rady";
			case 2: return "Członek Rady";
			case 3: return "Członek Komisji";
			case 4: return "Gość";
		}	
	}
	
	function blowfishSalt($cost = 13)
	{
		if (!is_numeric($cost) || $cost < 4 || $cost > 31) {
			throw new Exception("cost parameter must be between 4 and 31");
		}
		$rand = array();
		for ($i = 0; $i < 8; $i += 1) {
			$rand[] = pack('S', mt_rand(0, 0xffff));
		}
		$rand[] = substr(microtime(), 2, 6);
		$rand = sha1(implode('', $rand), true);
		$salt = '$2a$' . sprintf('%02d', $cost) . '$';
		$salt .= strtr(substr(base64_encode($rand), 0, 22), array('+' => '.'));
		return $salt;
	}
		
}
