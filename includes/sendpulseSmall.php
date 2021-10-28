<?php
//Это сендпульс
?>

<section class="sendpulse small">
	<div class="sendpulse__left">
        <span>
            Получать ежемесячно
            свежие обзоры на почту
        </span>
	</div>
	<div class="sendpulse__right">
        <form action="https://login.sendpulse.com/forms/simple/u/eyJ1c2VyX2lkIjozOTAxMTYsImFkZHJlc3NfYm9va19pZCI6ODg5ODE4NDYsImxhbmciOiJydSJ9" method="post">
            <div>
                <input type="hidden" name="sender" value="news@pgmedia.ru">
            </div>

            <div>
                <input placeholder="Email" type="email" required name="email">
                <span class="req red">
                    *
                </span>
            </div>

            <div>
                <label>
                    <input type="text" name="name" placeholder="Фамилия, Имя">
                    <span class="req red">
                        *
                    </span>
                </label>
            </div>

            <div>
                <label>
                    <input
                            type="checkbox"
                            value="yes"
                            required
                    />
                    <span class="inline">Подписываясь на рассылку, вы соглашаетесь с <a target="_blank" href="https://igrader.ru/rules/">Правилами пользования</a> и <a target="_blank" href="https://igrader.ru/for_users/">Политикой конфиденциальности</a> и <a target="_blank" href="https://igrader.ru/politika-obrabotki-personalnyih-dannyih/">обработку персональных данных</a> <strong class="red">*</strong></span>

                </label>
            </div>

            <button type="submit" class="orangeButton">Подписаться</button>
        </form>
    </div>
</section>

