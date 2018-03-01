<?php
/**
 * Created by PhpStorm.
 * User: Maria
 * Date: 25.02.2018
 * Time: 18:04
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">

                    <div class="signup-form"><!--sign up form-->
                        <h2>Реєстрація на сайті</h2>

                        <?php $form = ActiveForm::begin() ?>

                        <?=  $form->field($registration, 'email')->textInput() ?>
                        <?=  $form->field($registration, 'password')->passwordInput() ?>

                        <div class="form-group">
                            <?= Html::submitButton('Create account', ['class' => 'orange-btn']) ?>

                        </div>

                        <?php ActiveForm::end() ?>




<!--                        <form action="#" method="post">-->
<!--                            <input type="text" name="name" placeholder="Імя" value=""/>-->
<!--                            <p></p>-->
<!--                            <input type="email" name="email" placeholder="E-mail" value=""/>-->
<!--                            <p></p>-->
<!--                            <input type="password" name="password" placeholder="Пароль" value=""/>-->
<!--                            <p></p>-->
<!--                            <input type="submit" name="submit" class="btn btn-default" value="Реєстрація" />-->
<!--                        </form>-->
<!--                    </div><!--/sign up form-->

                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>
