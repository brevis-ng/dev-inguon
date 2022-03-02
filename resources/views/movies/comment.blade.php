<form id="commentform">
    @csrf
    <div class="container mx-auto flex flex-col md:flex-row mt-2">
        <div class="comment w-2/5">
            <div class="mb-6">
                <input type="text" name="name" id="name" class="block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500 rounded-md" placeholder="your name" required="">
            </div>
            <textarea id="message" name="message" rows="4" class="block p-2.5 w-full text-sm bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500 rounded-md" placeholder="Leave a comment..."></textarea>
            <button id="comment" type="submit" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Comment</button>
        </div>
    </div>
</form>

<script>

$(".save-data").click(function(event){
      event.preventDefault();

      let name = $("input[name=name]").val();
      let email = $("input[name=email]").val();
      let mobile_number = $("input[name=mobile_number]").val();
      let message = $("input[name=message]").val();
      let _token   = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: "/ajax-request",
        type:"POST",
        data:{
          name:name,
          email:email,
          mobile_number:mobile_number,
          message:message,
          _token: _token
        },
        success:function(response){
          console.log(response);
          if(response) {
            $('.success').text(response.success);
            $("#ajaxform")[0].reset();
          }
        },
        error: function(error) {
         console.log(error);
        }
       });
  });
</script>