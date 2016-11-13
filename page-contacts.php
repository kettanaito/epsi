<?php
    /* Template name: Materials */
    get_header();
    page_header();
    page_subheader();
    content_begin();
?>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3><?php _e('Отправить сообщение', THEME_NAME); ?></h3>
                    <form>
                        <input type="text" placeholder="<?php _e('Ваше имя', THEME_NAME); ?>">
                        <input type="email" placeholder="<?php _e('Электронный адрес', THEME_NAME); ?>">
                        <input type="tel" placeholder="<?php _e('Телефон', THEME_NAME); ?>">
                        <textarea placeholder="<?php _e('Ваше сообщение', THEME_NAME); ?>"></textarea>
                        <button type="submit"><?php _e('Отправить', THEME_NAME); ?></button>
                    </form>
                </div>
                <div class="col-md-6">
                    <h3><?php _e('Контактные данные', THEME_NAME); ?></h3>
                    <h4><?php _e('Адрес', THEME_NAME); ?></h4>
                    <p>Street name and number</p>
                    <section>
                        <h3><?php _e('Наша команда', THEME_NAME); ?></h3>
                        <ul>
                            <li>
                                <p class="name">Kate Johnson</p>
                                <p class="position">Manager</p>
                                <p class="phone">+38 (050) 442 90 25</p>
                                <p class="email">kate@epsi.com.ua</p>
                            </li>
                            <li>
                                <p class="name">Kate Johnson</p>
                                <p class="position">Manager</p>
                                <p class="phone">+38 (050) 442 90 25</p>
                                <p class="email">kate@epsi.com.ua</p>
                            </li>
                            <li>
                                <p class="name">Kate Johnson</p>
                                <p class="position">Manager</p>
                                <p class="phone">+38 (050) 442 90 25</p>
                                <p class="email">kate@epsi.com.ua</p>
                            </li>
                            <li>
                                <p class="name">Kate Johnson</p>
                                <p class="position">Manager</p>
                                <p class="phone">+38 (050) 442 90 25</p>
                                <p class="email">kate@epsi.com.ua</p>
                            </li>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </div>
<?php
    content_end();
    get_footer();
?>
