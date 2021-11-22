<!DOCTYPE html>
<html lang="{{ current_language }}">
	<head>
		{% include 'include/head.volt' %}
	</head>
	<body>
	<div class="page js-page">
		{% include 'include/header/header.volt' %}
		{{ content() }}
		<div id="footer">
			{% include 'include/footer/footer.volt' %}
		</div>
	</div>
	<script src="{{ layout_dir }}js/ocms.min.js"></script>
	<script src="{{ layout_dir }}js/custom.js"></script>
	</body>
</html>
