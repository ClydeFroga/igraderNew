<div id="modalSendpulse" class="modalSubscription ">
	<section class="container sendpulse large">
		<div class="sendpulse__left">
            <span>
            Подпишитесь <br>
            на ежемесячную рассылку <br>
            для специалистов отрасли <br>
        </span>
		</div>
		<div class="sendpulse__right">
            <form action="https://login.sendpulse.com/forms/simple/u/eyJ1c2VyX2lkIjo2Njk5ODMyLCJhZGRyZXNzX2Jvb2tfaWQiOjg4OTgxODQ2LCJsYW5nIjoicnUifQ==" method="post">
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
		<div id="closeModal" class="modalSubscription__close">
			<svg>
				<use href="<?php bloginfo('template_url')?>/svg/out/symbol/svg/sprite.symbol.svg#closeFrame"></use>
			</svg>
		</div>
	</section>
</div>
