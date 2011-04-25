<?php

/**
 * This is the model class for table "bookcomment".
 *
 * The followings are the available columns in table 'bookcomment':
 * @property string $bookcomment_id
 * @property string $book_id
 * @property string $user_id
 * @property string $content
 * @property string $add_time
 * @property string $star
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Books $book
 */
class Bookcomment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Bookcomment the static model class
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
		return 'bookcomment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('book_id, user_id, content', 'required'),
			array('book_id, user_id', 'length', 'max'=>10),
			array('content', 'length', 'max'=>255),
			array('star', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('bookcomment_id, book_id, user_id, content, add_time, star', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'book' => array(self::BELONGS_TO, 'Books', 'book_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'bookcomment_id' => 'Bookcomment',
			'book_id' => 'Book',
			'user_id' => 'User',
			'content' => 'Content',
			'add_time' => 'Add Time',
			'star' => 'Star',
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

		$criteria->compare('bookcomment_id',$this->bookcomment_id,true);
		$criteria->compare('book_id',$this->book_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('star',$this->star,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}