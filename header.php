<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <title><?= YoastSEO()->meta->for_current_page()->context->title ? YoastSEO()->meta->for_current_page()->context->title : the_title() ?></title>
    <?php wp_head();?> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="<?php bloginfo( 'charset' ); ?>">

</head>
<body <?php body_class(); ?>>
<?php wp_body_open();
include MEBELKA_REQUIRE_DIRECTORY . '/template-parts/content-variables.php';
$promo_end_data = get_field('promo_end_data' , 'option');
$promo_text_left = get_field('promo_text_left' , 'option');
$promo_text_right = get_field('promo_text_right' , 'option');
?>
<header class="header">

<?php
if ($promo_end_data) :
	$promo_end_data = str_ireplace(['пп', 'дп'], ['pm', 'am'], $promo_end_data);
	$date = DateTime::createFromFormat('d/m/Y g:i a', $promo_end_data, new DateTimeZone('Europe/Kiev'));
	if ($date && $date > new DateTime('now', new DateTimeZone('Europe/Kiev'))) :
		$formatted_date = $date->format('d.m.Y H:i');
?>
<div class="header__promo">
	<div class="container">
		<div class="header__promo__container">
			<?php if ($promo_text_left) : ?>
				<span><?= $promo_text_left ?></span>
			<?php endif; ?>
			<div class="countdown-timer" data-timer="<?= esc_attr($formatted_date) ?>">
				<div class="countdown-item">
					<div class="countdown-digits">
						<span class="countdown-digit" data-days-1>0</span>
						<span class="countdown-digit" data-days-2>1</span>
					</div>
					<span class="countdown-label"><?= __('Дней', 'mebelka') ?></span>
				</div>
				<span class="countdown-separator">:</span>
				<div class="countdown-item">
					<div class="countdown-digits">
						<span class="countdown-digit" data-hours-1>0</span>
						<span class="countdown-digit" data-hours-2>0</span>
					</div>
					<span class="countdown-label"><?= __('Часов', 'mebelka') ?></span>
				</div>
				<span class="countdown-separator">:</span>
				<div class="countdown-item">
					<div class="countdown-digits">
						<span class="countdown-digit" data-minutes-1>0</span>
						<span class="countdown-digit" data-minutes-2>0</span>
					</div>
					<span class="countdown-label"><?= __('Минут', 'mebelka') ?></span>
				</div>
				<span class="countdown-separator">:</span>
				<div class="countdown-item">
					<div class="countdown-digits">
						<span class="countdown-digit" data-seconds-1>0</span>
						<span class="countdown-digit" data-seconds-2>0</span>
					</div>
					<span class="countdown-label"><?= __('Секунд', 'mebelka') ?></span>
				</div>
			</div>
			<?php if ($promo_text_right) : ?>
				<span><?= $promo_text_right ?></span>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php
	endif;
endif;
?>


<!-- начало header-top -->
<div class="header__top">
	<!-- начало меню для декстопа -->
	<div class="header__top__wrap">
	<div class="container">
		<div class="header__top__container">			
			<div class="header__top__btns">
				<?php if($main_city) : ?>
				<button class="header__top__btns__local" data-open="popup__local">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
						<path d="M9.00044 1.50024C5.69204 1.50024 3.00104 4.19124 3.00104 7.49605C2.97854 12.3299 8.77274 16.3385 9.00044 16.5005C9.00044 16.5005 15.0223 12.3299 15.0007 7.50054C14.9991 5.90968 14.3664 4.38445 13.2415 3.25953C12.1165 2.13462 10.5913 1.50191 9.00044 1.50024ZM9.00044 10.5002C8.60646 10.5002 8.21633 10.4226 7.85233 10.2719C7.48834 10.1211 7.15761 9.90011 6.87902 9.62152C6.60043 9.34293 6.37944 9.0122 6.22866 8.6482C6.07789 8.28421 6.00029 7.89408 6.00029 7.50009C6.00029 7.10611 6.07789 6.71598 6.22866 6.35199C6.37944 5.98799 6.60043 5.65726 6.87902 5.37867C7.15761 5.10008 7.48834 4.87909 7.85233 4.72832C8.21633 4.57755 8.60646 4.49994 9.00044 4.49994C9.39443 4.49994 9.78455 4.57755 10.1485 4.72832C10.5125 4.87909 10.8433 5.10008 11.1219 5.37867C11.4005 5.65726 11.6214 5.98799 11.7722 6.35199C11.923 6.71598 12.0006 7.10611 12.0006 7.50009C12.0006 7.89408 11.923 8.28421 11.7722 8.6482C11.6214 9.0122 11.4005 9.34293 11.1219 9.62152C10.8433 9.90011 10.5125 10.1211 10.1485 10.2719C9.78455 10.4226 9.39443 10.5002 9.00044 10.5002Z" fill="#003944"/>
						</svg>
							<?= $main_city ?>
				</button>
				<?php endif;?>
				<div class="header__top__btns__contact">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
						<path d="M18.3328 14.1V16.6C18.3338 16.832 18.2863 17.0618 18.1934 17.2744C18.1005 17.4871 17.9642 17.678 17.7932 17.835C17.6222 17.9919 17.4203 18.1114 17.2005 18.1857C16.9806 18.2601 16.7477 18.2877 16.5165 18.2668C13.9522 17.9883 11.4889 17.1121 9.32465 15.7087C7.31118 14.4293 5.6041 12.7222 4.32465 10.7087C2.91638 8.53469 2.04001 6.05951 1.76653 3.4837C1.74571 3.25327 1.77309 3.02102 1.84693 2.80174C1.92077 2.58247 2.03945 2.38096 2.19542 2.21006C2.35139 2.03916 2.54123 1.9026 2.75286 1.80907C2.96449 1.71555 3.19328 1.66711 3.42465 1.66683H5.92465C6.32907 1.66284 6.72114 1.80601 7.02781 2.06968C7.33448 2.33334 7.53483 2.69951 7.59153 3.09995C7.69715 3.89995 7.89278 4.68558 8.17465 5.44183C8.28678 5.74006 8.31105 6.06419 8.24459 6.3758C8.17812 6.68741 8.02371 6.97343 7.79965 7.19995L6.74153 8.2587C7.92787 10.345 9.65527 12.0724 11.7415 13.2587L12.7997 12.2C13.0262 11.9759 13.3122 11.8215 13.6238 11.755C13.9354 11.6886 14.2595 11.7128 14.5578 11.825C15.314 12.1075 16.0997 12.3031 16.8997 12.4087C17.3044 12.4659 17.6741 12.6699 17.9383 12.9818C18.2025 13.2937 18.3429 13.6919 18.3328 14.1006V14.1Z" fill="#003944"/>
						</svg>
						<?php if($contact_phone) : ?>
						<div class="header__top__btns__contact__wrap">
							<a href="tel:<?= $contact_phone ?>"><?= $contact_phone ?></a>
							<span><?= __('заказать звонок' , 'mebelka') ?></span>
						</div>
						<?php endif; ?>
				</div>
			
			</div>
			<div class="header__top__nav">
				<?= mebelka_wpml_language_switcher(); ?>
				<nav>
				<?php
					if ( has_nav_menu( 'header-menu' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'header-menu',
							'container' => 'ul',
							'items_wrap' => '<ul id="%1$s" class="menu">%3$s</ul>',
						) );
					}
				?>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- конец меню для декстопа -->
 <!-- начало мобильного меню -->
	<div class="header__top__mobile">
		<div class="header__top__mobile__wrap">
		<div class="header__top__form header__form">
			<form action="">
				<div class="input__search">
				<input class="input__search-input-mobile" type="search" name="header_search" placeholder="Поиск...">
			</div>
			</form>
			<div class="header__search-results header__search-results-mobile">
				<div class="header__search-results__title"><?= __('Результат поиска' , 'mebelka') ?></div>
				<div class="header__search-wrapper-mobile"></div>
			</div>
			<div class="search-bg"></div>
		</div>
		<div class="header__top__nav__mobile">
			<nav>
				<nav>
				<?php
					if ( has_nav_menu( 'header-menu' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'header-menu',
							'container' => 'ul',
							'items_wrap' => '<ul id="%1$s" class="menu">%3$s</ul>',
						) );
					}
				?>
			</nav>
		</div>
		</div>
		<div class="header__top__btns-mobile">
			<div class="header__top__btns__item"> 
				<span><?= __('Телефон' , 'mebelka') ?></span>
				<div class="header__top__btns__contact">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
						<path d="M18.3328 14.1V16.6C18.3338 16.832 18.2863 17.0618 18.1934 17.2744C18.1005 17.4871 17.9642 17.678 17.7932 17.835C17.6222 17.9919 17.4203 18.1114 17.2005 18.1857C16.9806 18.2601 16.7477 18.2877 16.5165 18.2668C13.9522 17.9883 11.4889 17.1121 9.32465 15.7087C7.31118 14.4293 5.6041 12.7222 4.32465 10.7087C2.91638 8.53469 2.04001 6.05951 1.76653 3.4837C1.74571 3.25327 1.77309 3.02102 1.84693 2.80174C1.92077 2.58247 2.03945 2.38096 2.19542 2.21006C2.35139 2.03916 2.54123 1.9026 2.75286 1.80907C2.96449 1.71555 3.19328 1.66711 3.42465 1.66683H5.92465C6.32907 1.66284 6.72114 1.80601 7.02781 2.06968C7.33448 2.33334 7.53483 2.69951 7.59153 3.09995C7.69715 3.89995 7.89278 4.68558 8.17465 5.44183C8.28678 5.74006 8.31105 6.06419 8.24459 6.3758C8.17812 6.68741 8.02371 6.97343 7.79965 7.19995L6.74153 8.2587C7.92787 10.345 9.65527 12.0724 11.7415 13.2587L12.7997 12.2C13.0262 11.9759 13.3122 11.8215 13.6238 11.755C13.9354 11.6886 14.2595 11.7128 14.5578 11.825C15.314 12.1075 16.0997 12.3031 16.8997 12.4087C17.3044 12.4659 17.6741 12.6699 17.9383 12.9818C18.2025 13.2937 18.3429 13.6919 18.3328 14.1006V14.1Z" fill="#003944"/>
						</svg>
						<?php if($contact_phone) : ?>
						<div class="header__top__btns__contact__wrap">
							<a href="tel:<?= $contact_phone ?>"><?= $contact_phone ?></a>
							<span><?= __('заказать звонок' , 'mebelka') ?></span>
						</div>
						<?php endif;?>
				</div>
			</div>
			<div class="header__top__btns__item"> 
				<span><?= __('Язык','mebelka');?></span>
				<?= mebelka_wpml_language_switcher(); ?>
			</div>
			<?php if($main_city) : ?>
			<div class="header__top__btns__item"> 
				<span><?= __('Ваш город' , 'mebelka') ?></span>
				<button class="header__top__btns__local" data-open="popup__local">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
						<path d="M9.00044 1.50024C5.69204 1.50024 3.00104 4.19124 3.00104 7.49605C2.97854 12.3299 8.77274 16.3385 9.00044 16.5005C9.00044 16.5005 15.0223 12.3299 15.0007 7.50054C14.9991 5.90968 14.3664 4.38445 13.2415 3.25953C12.1165 2.13462 10.5913 1.50191 9.00044 1.50024ZM9.00044 10.5002C8.60646 10.5002 8.21633 10.4226 7.85233 10.2719C7.48834 10.1211 7.15761 9.90011 6.87902 9.62152C6.60043 9.34293 6.37944 9.0122 6.22866 8.6482C6.07789 8.28421 6.00029 7.89408 6.00029 7.50009C6.00029 7.10611 6.07789 6.71598 6.22866 6.35199C6.37944 5.98799 6.60043 5.65726 6.87902 5.37867C7.15761 5.10008 7.48834 4.87909 7.85233 4.72832C8.21633 4.57755 8.60646 4.49994 9.00044 4.49994C9.39443 4.49994 9.78455 4.57755 10.1485 4.72832C10.5125 4.87909 10.8433 5.10008 11.1219 5.37867C11.4005 5.65726 11.6214 5.98799 11.7722 6.35199C11.923 6.71598 12.0006 7.10611 12.0006 7.50009C12.0006 7.89408 11.923 8.28421 11.7722 8.6482C11.6214 9.0122 11.4005 9.34293 11.1219 9.62152C10.8433 9.90011 10.5125 10.1211 10.1485 10.2719C9.78455 10.4226 9.39443 10.5002 9.00044 10.5002Z" fill="#003944"/>
						</svg>
							<?= $main_city ?>
				</button>
			</div>
			<?php endif;?>
		</div>
	</div>
<!-- конец мобильного меню -->
</div>
<!-- конец header-top -->
<div class="header__bottom">
	<div class="container">
		<div class="header__bottom__container">
			<div class="burger">
				<span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
			</div>
			<?php
					if($site_logo) { ?>
					<a href="<?= get_home_url(); ?>" class="logo">
						<img src="<?= $site_logo ?>" alt="<?= the_title() ?>">
					</a>
					<?php } ?>
			<div class="header__bottom__form header__form">
				<!-- форма такая же как и в топе -->
				<form action="">
					<div class="input__search">
					<input class="input__search-input" type="search" name="header_search" placeholder="Поиск...">
				</div>
				</form>
				
				<div class="header__search-results-pc header__search-results">
					<div class="header__search-results__title"><?= __('Результат поиска' , 'mebelka') ?></div>
						<div class="header__search-wrapper">			
						</div>
				</div>
				<div class="search-bg"></div>
				
			</div>
			<div class="header__bottom__icons">
			<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="header__bottom__icons__item">
				<svg xmlns="http://www.w3.org/2000/svg" width="27" height="26" viewBox="0 0 27 26" fill="none">
				<path d="M17.256 2.556C17.7622 3.04632 18.1658 3.63247 18.4433 4.28032C18.7208 4.92816 18.8666 5.62474 18.8722 6.32948C18.8778 7.03422 18.7431 7.73303 18.4759 8.3852C18.2088 9.03737 17.8145 9.62986 17.3161 10.1282C16.8178 10.6265 16.2252 11.0206 15.573 11.2876C14.9208 11.5546 14.2219 11.6892 13.5172 11.6835C12.8125 11.6778 12.1159 11.5319 11.4681 11.2543C10.8203 10.9767 10.2342 10.573 9.744 10.0667C8.76257 9.06747 8.21547 7.7211 8.22176 6.32054C8.22804 4.91998 8.7872 3.57857 9.77755 2.58822C10.7679 1.59787 12.1093 1.03871 13.5099 1.03242C14.9104 1.02614 16.2568 1.57457 17.256 2.556ZM13.5 15.6773C19.572 15.6773 25.5 18.3 25.5 22.3333V23.6667C25.5 24.0203 25.3595 24.3594 25.1095 24.6095C24.8594 24.8595 24.5203 25 24.1667 25H2.83333C2.47971 25 2.14057 24.8595 1.89052 24.6095C1.64048 24.3594 1.5 24.0203 1.5 23.6667V22.3333C1.5 18.2987 7.428 15.6773 13.5 15.6773Z" stroke="white" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				<span><?= __('Аккаунт' , 'mebelka') ?></span>
			</a>
			<a href="<?= get_url_template('template-parts/page-favorite.php') ?>" class="header__bottom__icons__item">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="21" viewBox="0 0 24 21" fill="none">
					<path d="M16.5222 1C20.3967 1 23 4.53875 23 7.84C23 14.5256 12.1956 20 12 20C11.8044 20 1 14.5256 1 7.84C1 4.53875 3.60333 1 7.47778 1C9.70222 1 11.1567 2.08063 12 3.03063C12.8433 2.08063 14.2978 1 16.5222 1Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<div class="header__bottom__icons__item__count"  data-count="0"></div>
				<span><?= __('Избранное',  'mebelka') ?></span>
			</a>
			<a href="<?= function_exists('wc_get_cart_url') ? wc_get_cart_url() : '/cart/' ?>" class="header__bottom__icons__item">
				<svg xmlns="http://www.w3.org/2000/svg" width="23" height="20" viewBox="0 0 23 20" fill="none">
					<g clip-path="url(#clip0_810_18540)">
					<path d="M22.53 0.38C22.477 0.286556 22.4056 0.204893 22.32 0.14C22.2256 0.0691226 22.1161 0.0211901 22 0L0 0V1.6H2.58L6.49 12.35C6.70686 12.958 7.1047 13.4849 7.63 13.86C8.15702 14.2308 8.78563 14.4298 9.43 14.43H19.09V12.85H9.43C9.11201 12.8478 8.80199 12.7502 8.54 12.57C8.28865 12.3843 8.1002 12.126 8 11.83L7.27 9.77H18.62C19.0459 9.76571 19.4593 9.62558 19.8 9.37C20.1364 9.12221 20.3823 8.77093 20.5 8.37L22.6 1C22.6245 0.891364 22.6245 0.778636 22.6 0.67C22.5931 0.570083 22.5695 0.47204 22.53 0.38ZM18.87 8.18H6.66L4.26 1.6H20.74L18.87 8.18ZM10.52 16.75C10.26 16.4941 9.90981 16.3507 9.545 16.3507C9.18019 16.3507 8.83001 16.4941 8.57 16.75C8.31052 17.0179 8.16684 17.3771 8.17 17.75C8.16566 17.9351 8.19886 18.1191 8.26761 18.291C8.33636 18.4628 8.43923 18.619 8.57 18.75C8.83244 19.0012 9.18171 19.1414 9.545 19.1414C9.90829 19.1414 10.2576 19.0012 10.52 18.75C10.6508 18.619 10.7536 18.4628 10.8224 18.291C10.8911 18.1191 10.9243 17.9351 10.92 17.75C10.9232 17.3771 10.7795 17.0179 10.52 16.75ZM17.52 16.75C17.389 16.6192 17.2328 16.5164 17.061 16.4476C16.8891 16.3789 16.7051 16.3457 16.52 16.35C16.3384 16.3487 16.1584 16.3835 15.9903 16.4523C15.8223 16.5212 15.6696 16.6228 15.5412 16.7512C15.4128 16.8796 15.3112 17.0323 15.2423 17.2003C15.1735 17.3684 15.1387 17.5484 15.14 17.73C15.1357 17.9151 15.1689 18.0991 15.2376 18.271C15.3064 18.4428 15.4092 18.599 15.54 18.73C15.8047 18.9767 16.1531 19.1139 16.515 19.1139C16.8769 19.1139 17.2253 18.9767 17.49 18.73C17.6208 18.599 17.7236 18.4428 17.7924 18.271C17.8611 18.0991 17.8943 17.9151 17.89 17.73C17.8961 17.3681 17.7637 17.0176 17.52 16.75Z" fill="white"/>
					</g>
					<defs>
					<clipPath id="clip0_810_18540">
					<rect width="22.64" height="19.09" fill="white"/>
					</clipPath>
					</defs>
					</svg>
					<div class="header__bottom__icons__item__count" id="cart-count"><?= function_exists('WC') ? WC()->cart->get_cart_contents_count() : 0 ?></div>
				<span><?= __('Корзина' , 'mebelka') ?></span>
			</a>
			</div>
		</div>
	</div>
</div>
</header>