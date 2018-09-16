<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "constant".
 *
 * @property int $id
 * @property string $description
 * @property int $status
 * @property int $constant_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Constant $constant
 * @property Constant[] $constants
 * @property User[] $users
 * @property User[] $users0
 */
class Constant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'constant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'status', 'created_at'], 'required'],
            [['status', 'constant_id', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['constant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Constant::className(), 'targetAttribute' => ['constant_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'status' => 'Status',
            'constant_id' => 'Constant ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConstant()
    {
        return $this->hasOne(Constant::className(), ['id' => 'constant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConstants()
    {
        return $this->hasMany(Constant::className(), ['constant_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['job_id' => 'id']);
    }
}
