<?php
namespace frontend\models;

use common\models\Leader;
use common\models\Speciality;
use common\models\Student;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;

    public $last_name;
    public $first_name;
    public $parent_name;

    public $type;

    public $leader_grade;

    public $student_leader_id;
    public $student_speciality_id;
    public $student_speciality_name;
    public $student_speciality_number;

    public $email;
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'last_name', 'first_name', 'parent_name'], 'trim'],
            [['username', 'last_name', 'first_name', 'parent_name'], 'required'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['type', 'required'],
            ['type', 'integer'],
            ['type', 'in', 'range' => array_keys(User::typeLabels())],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['leader_grade', 'string'],
            ['leader_grade', 'required', 'when' => function ($model) {
                return $model->type == User::TYPE_LEADER;
            }, 'whenClient' => "whenLeader"
            ],

            ['student_leader_id', 'integer'],
            ['student_leader_id', 'exist', 'targetClass' => Leader::className(), 'targetAttribute' => 'user_id'],

            ['student_speciality_id', 'integer'],
            ['student_speciality_id', 'exist', 'targetClass' => Speciality::className()],

            [['student_speciality_name', 'student_speciality_number'], 'string'],
            [['student_speciality_name', 'student_speciality_number'], 'required', 'when' => function ($model) {
                return $model->type == User::TYPE_STUDENT && empty($model->student_speciality_id);
            }, 'whenClient' => "whenStudentSpeciality"],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $transaction = \Yii::$app->db->beginTransaction();
        $result = true;

        $user = new User();
        $user->username = $this->username;
        $user->last_name = $this->last_name;
        $user->first_name = $this->first_name;
        $user->parent_name = $this->parent_name;
        $user->type = $this->type;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $result &= $user->save();

        switch ($user->type) {
            case User::TYPE_STUDENT:
                $model = new Student();
                $model->user_id = $user->id;

                if (!empty($this->student_speciality_id)) {
                    $model->speciality_id = $this->student_speciality_id;
                } else {
                    $speciality = new Speciality();
                    $speciality->name = $this->student_speciality_name;
                    $speciality->number = $this->student_speciality_number;
                    $result &= $speciality->save();

                    $model->speciality_id = $speciality->id;
                }

                $result &= $model->save();

                break;
            case User::TYPE_LEADER:
                $model = new Leader();
                $model->user_id = $user->id;
                $model->grade = $this->leader_grade;

                $result &= $model->save();
                break;
            default:
                $result = false;
        }

        if ($result) {
            $transaction->commit();
            return $user;
        } else {
            $transaction->rollBack();
            return null;
        }
    }
}
