    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/11.1.1/classic/ckeditor.js"></script>
    <script>
			ClassicEditor
				.create( document.querySelector( '#editor' ) )
				.then( editor => {
					console.log( editor );
				} )
				.catch( error => {
					console.error( error );
				} );
		</script>
    <!-- Google chart -->
    <?php
        $query = "SELECT * FROM posts WHERE post_status = 'Published'";
        $select_all_published_posts = mysqli_query($connection, $query);
        $post_published_count = mysqli_num_rows($select_all_published_posts);

        $query = "SELECT * FROM posts WHERE post_status = 'Draft'";
        $select_all_draft_posts = mysqli_query($connection, $query);
        $post_draft_count = mysqli_num_rows($select_all_draft_posts);

        $query = "SELECT * FROM comments WHERE comment_status = 'Approved'";
        $select_all_approved_comments = mysqli_query($connection, $query);
        $comment_approved_count = mysqli_num_rows($select_all_approved_comments);

        $query = "SELECT * FROM comments WHERE comment_status = 'Unapproved'";
        $select_all_unapproved_comments = mysqli_query($connection, $query);
        $comment_unapproved_count = mysqli_num_rows($select_all_unapproved_comments);

        $query = "SELECT * FROM users WHERE user_role = 'admin'";
        $select_all_admins = mysqli_query($connection, $query);
        $admin_count = mysqli_num_rows($select_all_admins);

        $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
        $select_all_subscribers = mysqli_query($connection, $query);
        $subscriber_count = mysqli_num_rows($select_all_subscribers);
    ?>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {

        var button = document.getElementById('change-chart');
        var chartDiv = document.getElementById('chart_div');

        var data = google.visualization.arrayToDataTable([
          ['Data', '*/_', '_/*'],
          <?php
                $element_data = ['Published/Draft', 'Approved/Unapproved', 'Admin/Subs', 'Categories'];
                $element_main = [$post_published_count,  $comment_approved_count, $admin_count, $category_count];
                $element_draft = [$post_draft_count, $comment_unapproved_count, $subscriber_count, 0];

                for($i=0; $i < 4; $i++){
                    echo "['$element_data[$i]', $element_main[$i], $element_draft[$i]],";
                }
                
            ?>
          
        ]);

        var materialOptions = {
          width: 900,
          chart: {
            title: '',
            subtitle: ''
          },
          series: {
            0: { axis: '' }, // Bind series 0 to an axis named 'distance'.
            1: { axis: '' } // Bind series 1 to an axis named 'brightness'.
          },
          axes: {
            y: {
              distance: {label: ''}, // Left y-axis.
              brightness: {side: '', label: ''} // Right y-axis.
            }
          }
        };

        var classicOptions = {
          width: 900,
          series: {
            0: {targetAxisIndex: 0},
            1: {targetAxisIndex: 1}
          },
          title: '',
          vAxes: {
            // Adds titles to each axis.
            0: {title: ''},
            1: {title: ''}
          }
        };

        function drawMaterialChart() {
          var materialChart = new google.charts.Bar(chartDiv);
          materialChart.draw(data, google.charts.Bar.convertOptions(materialOptions));
          button.innerText = 'Change to Classic';
          button.onclick = drawClassicChart;
        }

        function drawClassicChart() {
          var classicChart = new google.visualization.ColumnChart(chartDiv);
          classicChart.draw(data, classicOptions);
          button.innerText = 'Change to Material';
          button.onclick = drawMaterialChart;
        }

        drawMaterialChart();
    };
    </script>
    

</body>

</html>