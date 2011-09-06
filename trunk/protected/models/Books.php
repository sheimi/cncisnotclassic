<?php

/**
 * This is the model class for table "books".
 *
 * The followings are the available columns in table 'books':
 * @property string $book_id
 * @property string $book_name
 * @property string $isbn
 * @property string $provider
 * @property string $cover_path
 * @property string $add_time
 * @property string $author
 * @property string $publisher
 * @property string $comment
 * @property string $pubdate
 * @property string $price
 *
 * The followings are the available model relations:
 * @property Bookcomment[] $bookcomments
 * @property BvHistory[] $bvHistories
 * @property CourseBook[] $courseBooks
 * @property OwnerBook[] $ownerBooks
 */
class Books extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Books the static model class
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
		return 'books';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('provider', 'required'),
			array('book_name, cover_path, author, publisher', 'length', 'max'=>128),
			array('isbn', 'length', 'max'=>16),
			array('provider', 'length', 'max'=>10),
			array('comment', 'length', 'max'=>255),
			array('price', 'length', 'max'=>8),
			array('add_time, pubdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('book_id, book_name, isbn, provider, cover_path, add_time, author, publisher, comment, pubdate, price', 'safe', 'on'=>'search'),
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
			'bookcomments' => array(self::HAS_MANY, 'Bookcomment', 'book_id'),
			'bvHistories' => array(self::HAS_MANY, 'BvHistory', 'book_id'),
			'courseBooks' => array(self::HAS_MANY, 'CourseBook', 'book_id'),
			'ownerBooks' => array(self::HAS_MANY, 'OwnerBook', 'book_id'),
		
			'providerdetail' => array(self::BELONGS_TO, 'Users', 'provider'),
		    'bookowner' => array(self::HAS_MANY, 'OwnerBook', 'book_id'),
			'bookComment' => array(self::HAS_MANY, 'Bookcomment', 'book_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'book_id' => 'Book',
			'book_name' => 'Book Name',
			'isbn' => 'Isbn',
			'provider' => 'Provider',
			'cover_path' => 'Cover Path',
			'add_time' => 'Add Time',
			'author' => 'Author',
			'publisher' => 'Publisher',
			'comment' => 'Comment',
			'pubdate' => 'Pubdate',
			'price' => 'Price',
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

		$criteria->compare('book_id',$this->book_id,true);
		$criteria->compare('book_name',$this->book_name,true);
		$criteria->compare('isbn',$this->isbn,true);
		$criteria->compare('provider',$this->provider,true);
		$criteria->compare('cover_path',$this->cover_path,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('publisher',$this->publisher,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('pubdate',$this->pubdate,true);
		$criteria->compare('price',$this->price,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}