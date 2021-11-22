{% block body %}

	<div class="header-back header-back-simple header-back-small">
		<div class="header-back-container">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<!-- Page Info -->
						<div class="page-info page-info-simple">
							<h1 class="page-title">{{ title }}</h1>
						</div>
						<!-- End Page Info -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="content">
		<div class="container">
			<div class="layout with-right-sidebar js-layout">
				<div class="row">
					<div class="col-md-9">
						<div class="main-content">
							{{ content() }}
{#							{{ include ('sidebar/left.html.twig') }}#}
{#							{{ include ('sidebar/right.html.twig') }}#}
{#							{{ include ('sidebar/middle.html.twig') }}#}
{#							{{ include ('sidebar/bottom.html.twig') }}#}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

{% endblock %}
