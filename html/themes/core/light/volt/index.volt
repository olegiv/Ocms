<!DOCTYPE html>
<html lang="{{ current_language }}">
	<head>
		{% include 'include/head.volt' %}
	</head>
	<body>
	<div class="">
		{% include 'include/header/header.volt' %}
		{{ content() }}
		<div id="footer">
			{% include 'include/footer/footer.volt' %}
		</div>
	</div>
	<script src="{{ layout_dir }}js/custom.js"></script>
	</body>
</html>
