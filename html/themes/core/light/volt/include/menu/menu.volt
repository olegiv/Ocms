{% set topMenu = [
	'index': [
		'title': 'Homepage',
		'uri': '/',
		'with_auth': false
	],
	'download': [
		'title': 'Download',
		'uri': '/download',
		'with_auth': false
	],
	'blog': [
		'title': 'Blog',
		'uri': '/blog',
		'with_auth': false
	],
	'about': [
		'title': 'About',
		'uri': '/about',
		'with_auth': false
	]
] %}

<nav class="">
	<ul class="">
		{% for controller, menu in topMenu %}
			<li>
				<a href="{{ menu['uri'] }}">{{ menu['title'] }}</a>
			</li>
		{% endfor %}
	</ul>
</nav>
