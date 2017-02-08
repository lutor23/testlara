
<!-- Algolia -->

<style>

/*.algolia-autocomplete {
  width: 100%;
}
.algolia-autocomplete .aa-input, .algolia-autocomplete .aa-hint {
  width: 100%;
  min-height: 30px;
  text-indent: 10px;
}

.algolia-autocomplete .aa-hint {
  color: #999;
}*/

.algolia-autocomplete .aa-dropdown-menu {
  width: 150%;
  background-color: #fff;
  border: 1px solid #999;
  border-top: none;
}
.algolia-autocomplete .aa-dropdown-menu .aa-suggestion {
  cursor: pointer;
  padding: 5px 4px;
}
.algolia-autocomplete .aa-dropdown-menu .aa-suggestion.aa-cursor {
  background: #f8f8f8;
}
.algolia-autocomplete .aa-dropdown-menu .aa-suggestion em {
  font-weight: bold;
  font-style: normal;
}
.algolia-autocomplete .category {
  text-align: center;
  background: #efefef;
  padding: 10px 5px;
  font-weight: bold;
}

/* enable absolute positioning */
.inner-addon { 
    position: relative; 
}

/* style icon */
.inner-addon .glyphicon {
  position: absolute;
  padding: 10px;
  pointer-events: none;
}

/* align icon */
.left-addon .glyphicon  { left:  0px;}
.right-addon .glyphicon { right: 0px;}

/* add padding  */
.left-addon input  { padding-left:  30px; }
.right-addon input { padding-right: 30px; }




  </style>


<script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script src="https://cdn.jsdelivr.net/hogan.js/3.0/hogan.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script>
  var client = algoliasearch( "{{ env('ALGOLIA_APP_ID') }}", "{{ env('ALGOLIA_SEARCH') }}");

  var dashboards = client.initIndex('dashboards');
  var widgets = client.initIndex('widgets');
  var urls = client.initIndex('urls');


  // Mustache templating by Hogan.js (http://mustache.github.io/)
  var templateDashboard = Hogan.compile('<div class="dashboard">' +
    '<div class="name"><i class="fa fa-dashboard"></i>  @{{{ _highlightResult.title.value }}} </div>'+'</div>');

  var templateWidget = Hogan.compile('<div class="widget">' +
    '<div class="name"><i class="fa fa-th"></i> @{{{ _highlightResult.title.value }}}</div>' + '</div>');

  var templateUrl = Hogan.compile('<div class="url">' +
    '<div class="name"><i class="fa fa-external-link"></i> @{{{ _highlightResult.title.value }}}</div>' + '</div>');

  // autocomplete.js initialization
  var selection_type='none';

  autocomplete('#navbar-search-input', {autoselect: true}, [
    {
      source: autocomplete.sources.hits(dashboards, {hitsPerPage: 3}),
      displayKey: 'dashboards',
      templates: {
        header: '<div class="category">Dashboards</div>',

        suggestion: function(hit) {
          // render the hit using Hogan.js        
          hit.selection_type='dashboard';
          return templateDashboard.render(hit);
        }
      }
    },
    {
      source: autocomplete.sources.hits(widgets, {hitsPerPage: 5}),
      displayKey: 'widgets',
      templates: {
        header: '<div class="category">Widgets</div>',
        suggestion: function(hit) {
          // render the hit using Hogan.js
          hit.selection_type='widgets';         
          return templateWidget.render(hit);
        }
      }
    },
    {
      source: autocomplete.sources.hits(urls, {hitsPerPage: 5}),
      displayKey: 'urls',
      templates: {
        header: '<div class="category">Urls</div>',
        suggestion: function(hit) {
          // render the hit using Hogan.js
          hit.selection_type='urlobject';
          return templateUrl.render(hit);
        }
      }
    }

  ]).on('autocomplete:selected', function(event, suggestion, dataset) {

    url='/'+suggestion.selection_type+'/'+suggestion.id;
    
    console.log(url);
    window.location.href = url;

  });
</script>