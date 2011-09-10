<?php

/**
 * This is the model class for table "course_Book".
 *
 * The followings are the available columns in table 'course_Book':
 * @property string $c_b_id
 * @property string $book_id
 * @property string $course_id
 * @property string $recommender_id
 *
 * The followings are the available model relations:
 * @property CbUpDown[] $cbUpDowns
 * @property Books $book
 * @property Course $course
 */
class CourseBook extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CourseBook the static model class
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
		return 'course_book';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('book_id, course_id, recommender_id', 'required'),
			array('book_id, course_id', 'length', 'max'=>10),
			array('recommender_id', 'length', 'max'=>8),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('c_b_id, book_id, course_id, recommender_id', 'safe', 'on'=>'search'),
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
			'cbUpDowns' => array(self::HAS_MANY, 'CbUpDown', 'cb_id'),
			'book' => array(self::BELONGS_TO, 'Books', 'book_id'),
			'course' => array(self::BELONGS_TO, 'Course', 'course_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'c_b_id' => 'C B',
			'book_id' => 'Book',
			'course_id' => 'Course',
			'recommender_id' => 'Recommender',
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

		$criteria->compare('c_b_id',$this->c_b_id,true);
		$criteria->compare('book_id',$this->book_id,true);
		$criteria->compare('course_id',$this->course_id,true);
		$criteria->compare('recommender_id',$this->recommender_id,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}