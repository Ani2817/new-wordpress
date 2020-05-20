<script type="text/javascript">
        var neighbourhood = null;
        var price = null;
        var location = null;

        function neighborhood_update(x){
          if(this.checked){
           neighbourhood=x.value;

          }
          request_ajax();
        }
        function price_update(x){
          if(this.checked){
           price=x.value;
          }
          request_ajax();
        }
        function location_update(x){
          if(this.checked){
           location=x.value;
          }
          request_ajax();
        }

        function request_ajax(){
          alert (neighborhood + " " + price + " " + location);
        }
      </script>