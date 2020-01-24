<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>John students</title>
  <link href="w3.css" ref="stylesheet"/>
  </head>
  <body>
    <div class="w3-container">
      <p><br/></p>
      <table class="w3-table w3-bordered w3-striped">
      <thead>
        <tr class="w3-red">
          <th>FirstName</th>
          <th>LastName</th>
          <th>Gender</th>
          </tr>
          </thead>
          <tbody id="mydata" >
            <tr>
              <td>[[firstname]]</td>
                <td>[[lastname]]</td>
                  <td>[[gender]]</td>
              </tr>
              </tbody>
              </table>
      </div>
    <script src="jquery.min.js"></script>
    <script src="jquery.miranda.min.js"></script>
    <script type="text/javascript">
      var listdata=[
            {"firstname":"tedir","lastname":"ghazali","gender":"male"},
              {"firstname":"moly","lastname":"holy","gender":"female"},
                {"firstname":"amith","lastname":"ghazali","gender":"male"},
                  {"firstname":"amutha","lastname":"gaana","gender":"female"},
                    {"firstname":"mandir","lastname":"andar","gender":"male"}
      ];
      $("#mydata").mirandajs(listdata);
      </script>


    </body>
</html>
