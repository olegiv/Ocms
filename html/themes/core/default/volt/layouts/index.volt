{% block body %}

	<div class="header-back header-back-default header-back-full-page js-full-page">
		<div class="header-back-container">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="page-info helper center">
							<h1 class="page-title">Opossum CMS</h1>
							<h2 class="page-description">Brings your site to the next level.</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="content">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Promo Title -->
					<div class="promo-title-wrapper helper pt60">
						<h3 class="promo-title" data-icon="&#xe6af">Unique Features</h3>
						<p class="promo-description">The most laconic CMS on the market - a real MVP - Minimum viable product!</p>
					</div>
					<!-- End of Promo Title -->
					<div class="row">
						<div class="col-md-6">
							<!-- Box -->
							<div class="box box-small-icon-alt">
								<i class="pe-7s-plugin box-icon"></i>
								<h4 class="box-title">Architecture</h4>
								<p class="box-description">No any heavy frameworks behind.</p>
							</div>
							<!-- End of Box -->
						</div>
						<div class="col-md-6">
							<!-- Box -->
							<div class="box box-small-icon-alt">
								<i class="pe-7s-eyedropper box-icon"></i>
								<h4 class="box-title">Templates</h4>
								<p class="box-description">Twig templates only.</p>
							</div>
							<!-- End of Box -->
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<!-- Box -->
							<div class="box box-small-icon-alt">
								<i class="pe-7s-tools box-icon"></i>
								<h4 class="box-title">Source code</h4>
								<p class="box-description">Open source, hosted on GitHub.</p>
							</div>
							<!-- End of Box -->
						</div>
						<div class="col-md-6">
							<!-- Box -->
							<div class="box box-small-icon-alt">
								<i class="pe-7s-cup box-icon"></i>
								<h4 class="box-title">Techologies</h4>
								<p class="box-description">Edge versions only used (PHP 7).</p>
							</div>
							<!-- End of Box -->
						</div>
					</div>
					<!-- Promo Title -->
					<div class="promo-title-wrapper ">
						<h3 class="promo-title" data-icon="&#xe629"> How it works </h3>
						<p class="promo-description">Index file source code:</p>
					</div>
					<!-- End of Promo Title -->
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8 col-sm-12">
							<div class="code-highlight ">
								<span class="js-copy-to-clipboard copy-code">copy</span>
								<pre><code class="language-php php-code">
&lt;?php declare(strict_types=1);

use Dotenv\Dotenv;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;

try {

	$rootPath = realpath('..');
	require_once $rootPath . '/vendor/autoload.php';

	/**
	 * Load configuration from .env
	 */
	Dotenv::createImmutable($rootPath)->load();

	/**
	 * Init Phalcon Dependency Injection
	 */
	$di = new FactoryDefault();
	$di->offsetSet('rootPath', function() use ($rootPath) {
		return $rootPath;
	});

	/**
	 * Register Service Providers
	 */
	$providersFile = $rootPath . '/config/providers.php';
	if (!file_exists($providersFile) || !is_readable($providersFile)) {
		throw new Exception('File /config/providers.php does not exist or is not readable.');
	}

	/** @var array $providers */
	$providers = include_once $providersFile;
	foreach ($providers as $provider) {
		$di->register(new $provider());
	}

	(new Application($di))
		->handle($_SERVER['REQUEST_URI'])
		->send();

} catch (Exception $e) {
	echo $e->getMessage() . '<br>';
	echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
								</code></pre>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="background-gradient-grey">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<!-- Promo Title -->
						<div class="promo-title-wrapper ">
							<h3 class="promo-title" data-icon="&#xe6c9">Give it a try</h3>
							<p class="promo-description">Download Opossum CMS</p>
						</div>
						<!-- End of Promo Title -->
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="helper center mb60">
							<a href="/download" class="reguest-demo-button button blue stroke rounded button-icon button-icon-right">Download
								<i class="fa fa-angle-right"></i>
							</a>
						</div>
						<div class="helper center pb60">
							<img src="{{ layout_dir }}img/front/opossum-bw.png" class="image remove-border" alt="Cute opossum"> </div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Promo Title -->
					<div class="promo-title-wrapper ">
						<h3 class="promo-title" data-icon="&#xe642">Make your life easier</h3>
						<p class="promo-description">Use an easy CMS with secure code and predictable behavior.</p>
					</div>
					<!-- End of Promo Title -->
					<!-- Featured Boxes -->
					<ul class="featured-boxes">
						<li class="featured-boxes-item">
							<img src="{{ layout_dir }}img/front/security.png" class="featured-boxes-item-ico" alt="Security">
							<h5 class="featured-boxes-item-pretitle">more</h5>
							<h4 class="featured-boxes-item-title">Security</h4>
							<p class="featured-boxes-item-description">Opossum CMS brings more security to your applications!</p>
							<a href="#" class="featured-boxes-item-button button blue stroke rounded"> Learn more </a>
						</li>
						<li class="featured-boxes-item">
							<img src="{{ layout_dir }}img/front/innovation.png" class="featured-boxes-item-ico" alt="Innovation">
							<h5 class="featured-boxes-item-pretitle">more</h5>
							<h4 class="featured-boxes-item-title">Innovation</h4>
							<p class="featured-boxes-item-description">Opossum CMS uses edge techologies!</p>
							<a href="#" class="featured-boxes-item-button button blue stroke rounded"> Learn more </a>
						</li>
						<li class="featured-boxes-item">
							<img src="{{ layout_dir }}img/front/success.png" class="featured-boxes-item-ico" alt="Success">
							<h5 class="featured-boxes-item-pretitle">more</h5>
							<h4 class="featured-boxes-item-title">Success</h4>
							<p class="featured-boxes-item-description">Opossum CMS brings more success to you!</p>
							<a href="#" class="featured-boxes-item-button button blue stroke rounded"> Learn more </a>
						</li>
					</ul>
					<!-- End of Featured Boxes -->
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<!-- Video section -->
					<div class="video-section video-section-fullwidth ">
						<img src="{{ layout_dir }}img/helpers/play-colored.png" alt="Play video" class="video-section-button-img js-video-trigger" data-video="<iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/N8VPvIpU5A8&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture&quot; allowfullscreen></iframe>"> </div>
					<!-- Endd  of Video section -->
					<!-- Video Trigger Modal -->
					<div class="js-video-trigger-modal video-trigger-modal">
						<div class="js-video-trigger-modal-content video-trigger-modal-content"></div>
					</div>
					<!-- End of Video Trigger Modal -->
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!--<div class="promo-title-wrapper ">
						<h3 class="promo-title" data-icon="&#xe6b3"> Our Plans </h3>
						<p class="promo-description">Quisque pellentesque tempor tortor. Morbi quis turpis eget tellus dapibus vestibulum sed sit amet lectus.</p>
					</div>
					<div class="row">
						<div class="col-md-4 col-sm-6">
							<div class="price-list">
								<h3 class="price-list-title">Free</h3>
								<p class="price-list-price">$0
									<span class="price-list-price-units">/mo</span>
								</p>
								<ul class="price-list-features">
									<li class="price-list-feature-item "> Nobis animi maxim. </li>
									<li class="price-list-feature-item "> Excepturi corrupti veritati. </li>
									<li class="price-list-feature-item "> Vitae eligendi fug. </li>
									<li class="price-list-feature-item "> Voluptas, numqua. </li>
									<li class="price-list-feature-item feature-is-disabled"> </li>
									<li class="price-list-feature-item feature-is-disabled"> </li>
									<li class="price-list-feature-item feature-is-disabled"> </li>
									<li class="price-list-feature-item feature-is-disabled"> </li>
								</ul>
								<a href="#" class="price-list-button">Select Plan</a>
							</div>
						</div>
						<div class="col-md-4 col-sm-6">
							<div class="price-list">
								<h3 class="price-list-title">Standard</h3>
								<p class="price-list-price">$10
									<span class="price-list-price-units">/mo</span>
								</p>
								<ul class="price-list-features">
									<li class="price-list-feature-item "> Nobis animi maxim. </li>
									<li class="price-list-feature-item "> Excepturi corrupti veritati. </li>
									<li class="price-list-feature-item "> Vitae eligendi fug. </li>
									<li class="price-list-feature-item "> Voluptas, numqua. </li>
									<li class="price-list-feature-item "> Nemo enim. </li>
									<li class="price-list-feature-item feature-is-disabled"> </li>
									<li class="price-list-feature-item feature-is-disabled"> </li>
									<li class="price-list-feature-item feature-is-disabled"> </li>
								</ul>
								<a href="#" class="price-list-button">Select Plan</a>
							</div>
						</div>
						<div class="col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-0">
							<div class="price-list">
								<h3 class="price-list-title">Pro</h3>
								<p class="price-list-price">$29
									<span class="price-list-price-units">/mo</span>
								</p>
								<ul class="price-list-features">
									<li class="price-list-feature-item "> Nobis animi maxim. </li>
									<li class="price-list-feature-item "> Excepturi corrupti veritati. </li>
									<li class="price-list-feature-item "> Vitae eligendi fug. </li>
									<li class="price-list-feature-item "> Voluptas, numqua. </li>
									<li class="price-list-feature-item "> Nemo enim. </li>
									<li class="price-list-feature-item "> Dolore optio expedit. </li>
									<li class="price-list-feature-item "> Odit tenetur. </li>
									<li class="price-list-feature-item "> Vitae omnis eni. </li>
								</ul>
								<a href="#" class="price-list-button">Select Plan</a>
							</div>
						</div>
					</div>-->
					<!-- Promo Title -->
					<div class="promo-title-wrapper ">
						<h3 class="promo-title" data-icon="&#xe661">Sites using Opossum CMS</h3>
						<p class="promo-description">Join us - use Opossum CMS!</p>
					</div>
					<!-- End of Promo Title -->
					<!-- Brands -->
					<ul class="brands ">
						<li class="brand-item">
							<a href="https://opossum.su/" target="_blank" class="brand-item-link">
								<img src="{{ layout_dir }}img/front/300x100-opossum.png" class="brand-item-image" alt="Opossum Digest"> </a>
						</li>
						<li class="brand-item">
							<a href="https://it-digest.info/" target="_blank" class="brand-item-link">
								<img src="{{ layout_dir }}img/front/300x100-itd.png" class="brand-item-image" alt="IT Digest"> </a>
						</li>
					</ul>
					<!-- End of Brands -->
					<!--<div class="promo-title-wrapper ">
						<h3 class="promo-title" data-icon="&#xe668"> Testimonials </h3>
						<p class="promo-description">Quisque pellentesque tempor tortor. Morbi quis turpis eget tellus dapibus vestibulum sed sit amet lectus.</p>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="testimonial">
								<div class="testimonial-photo-wrapper">
									<img src="{{ layout_dir }}img/front/128-kylie.jpg" class="testimonial-photo" alt="Kylie the Opossum&#39;s Photo"> </div>
								<h4 class="testimonial-name">Kylie the Opossum</h4>
								<p class="testimonial-text">Quisque pellentesque tempor tortor. Morbi quis turpis eget tellus dapibus vestibulum sed sit amet lectus.</p>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="testimonial">
								<div class="testimonial-photo-wrapper">
									<img src="{{ layout_dir }}img/front/128-fox.jpg" class="testimonial-photo" alt="Mr. Fox&#39;s Photo"> </div>
								<h4 class="testimonial-name">Mr. Fox</h4>
								<p class="testimonial-text">Quisque pellentesque tempor tortor. Morbi quis turpis eget tellus dapibus vestibulum sed sit amet lectus.</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="testimonial">
								<div class="testimonial-photo-wrapper">
									<img src="{{ layout_dir }}img/front/128-bean.jpg" class="testimonial-photo" alt="Franklin Bean&#39;s Photo"> </div>
								<h4 class="testimonial-name">Franklin Bean</h4>
								<p class="testimonial-text">Quisque pellentesque tempor tortor. Morbi quis turpis eget tellus dapibus vestibulum sed sit amet lectus.</p>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="testimonial">
								<div class="testimonial-photo-wrapper">
									<img src="{{ layout_dir }}img/front/128-boggis.jpg" class="testimonial-photo" alt="Walter Boggis&#39;s Photo"> </div>
								<h4 class="testimonial-name">Walter Boggis</h4>
								<p class="testimonial-text">Quisque pellentesque tempor tortor. Morbi quis turpis eget tellus dapibus vestibulum sed sit amet lectus.</p>
							</div>
						</div>
					</div>-->
				</div>
			</div>
		</div>
		<!-- Call to Action -->
		<div class="call-to-action helper mt60">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h3 class="call-to-action-title"> Got a minute? Join us, it's free! </h3>
						<p class="call-to-action-description">Visit our Facebook page.</p>
						<div class="call-to-action-buttons">
							<a href="https://www.facebook.com/it.digest.info" target="_blank" class="call-to-action-button">Get Started</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End of Call to Action -->
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Promo Title -->
					<div class="promo-title-wrapper promo-title-no-icon">
						<h3 class="promo-title" data-icon="&#xe6af"> FAQ </h3>
						<p class="promo-description">Quisque pellentesque tempor tortor. Morbi quis turpis eget tellus dapibus vestibulum sed sit amet lectus.</p>
					</div>
					<!-- End of Promo Title -->
					<div class="row">
						<div class="col-md-4">
							<!-- FAQ Grid -->
							<div class="faq-grid">
								<h4 class="faq-grid-question">Where do I get an overview?</h4>
								<p class="faq-grid-answer">Quisque pellentesque tempor tortor. Morbi quis turpis eget tellus dapibus vestibulum sed sit amet lectus.</p>
							</div>
							<!-- End of FAQ Grid -->
						</div>
						<div class="col-md-4">
							<!-- FAQ Grid -->
							<div class="faq-grid">
								<h4 class="faq-grid-question">How do I request a feature?</h4>
								<p class="faq-grid-answer">Quisque pellentesque tempor tortor. Morbi quis turpis eget tellus dapibus vestibulum sed sit amet lectus.</p>
							</div>
							<!-- End of FAQ Grid -->
						</div>
						<div class="col-md-4">
							<!-- FAQ Grid -->
							<div class="faq-grid">
								<h4 class="faq-grid-question">How do I update?</h4>
								<p class="faq-grid-answer">Quisque pellentesque tempor tortor. Morbi quis turpis eget tellus dapibus vestibulum sed sit amet lectus.</p>
							</div>
							<!-- End of FAQ Grid -->
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="helper center">
								<a href="#" class="faq-grid-show-more">View all
									<i class="fa fa-angle-right"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

{% endblock %}

