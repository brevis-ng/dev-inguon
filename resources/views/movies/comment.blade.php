<div class="container mx-auto px-4 py-6 flex ">
    <div class="w-2/5">
        <form id="commentform">
            <div class="container mx-auto flex flex-col mt-2">
                <div class="comment w-4/5">
                    <div class="mb-6">
                        <input type="text" name="Author" class="focus:outline-none block w-full p-2.5 bg-gray-700 placeholder-gray-400 text-white rounded-md" placeholder="Tên của bạn" required="">
                    </div>
                    <textarea name="Content" rows="4" class="focus:outline-none block p-2.5 w-full text-sm bg-gray-700 placeholder-gray-400 text-white rounded-md" placeholder="Nhận xét của bạn..."></textarea>
                    <button id="comment" type="submit" class="mt-2 text-white font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Comment</button>
                </div>
            </div>
        </form>
    </div>
    <div class="w-3/5 scroll-m-0 overflow-y-auto md:h-auto max-h-60 scrollbar-thin scrollbar-thumb-slate-700 rounded-lg" id="boxcomment">
        @foreach($comment as $key => $value )
        <div class="container mx-auto flex flex-col">
            <div class="p-5 border bg-gray-800 border-gray-700">
                <time class="text-lg font-semibold text-white">{{$key}}</time>
                @foreach($value as $item )
                <ol class="divide-y divide-gray-700 pt-4" id="listcomment">
                    <li>
                        <a href="#" class="block items-center p-1 sm:flex hover:bg-gray-700">
                            <img class="mr-3 mb-3 w-10 h-10 rounded-full sm:mb-0" src="/img/avatar_default.jpg" alt="avatar">
                            <span>{{$item['Author']}}:</span>
                            <div class="text-gray-400">
                                <div class="text-sm font-normal ml-2">"{{$item['Content']}}"</div>
                            </div>
                        </a>
                    </li>
                </ol>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>
<script>
    var count =0;
    $("#comment").click(function(event) {
        event.preventDefault();
        $('#comment').prop('disabled', true);
        let Author = $("input[name=Author]").val();
        let Content = $("textarea[name=Content]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        let IdVod = <?= json_encode($movie['id']) ?>;
        let countcm = <?= json_encode($comment) ?>;
        let todayDate = new Date().toISOString().slice(0, 10);

        $.ajax({
            url: "/comment",
            type: "POST",
            data: {
                IdVod: IdVod,
                Author: Author,
                Content: Content,
                _token: _token
            },
            success: function(response) {
                if (response && Author!="" && Content !="" ) {
                    $('#comment').removeAttr('disabled');
                    if(Object.keys(countcm).length < 1 && count==0)
                        $('#boxcomment').append('<div class="container mx-auto flex flex-col mt-2"><div class="p-5 mb-4 rounded-lg border bg-gray-800 border-gray-700"><time class="text-lg font-semibold text-white">'+todayDate+'</time><ol class="mt-3 divide-y divide-gray-700" id="listcomment"><li><a href="#" class="block items-center p-3 sm:flex hover:bg-gray-700"><img class="mr-3 mb-3 w-10 h-10 rounded-full sm:mb-0" src="/img/avatar_default.jpg" alt="avatar"><span>'+Author+'</span><div class="text-gray-400"><div class="text-sm font-normal ml-2">'+Content+'</div></div></a></li></ol></div></div>');
                    else 
                        $('#listcomment').prepend('<li><a href="#" class="block items-center p-3 sm:flex hover:bg-gray-700"><img class="mr-3 mb-3 w-10 h-10 rounded-full sm:mb-0" src="/img/avatar_default.jpg" alt="avatar"><span class="text-blue-300">' + Author + '</span><div class="text-blue-300"><div class="text-sm font-normal ml-2">' + Content + '</div></div></a></li>');
                    $("#commentform")[0].reset();
                    count++;
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>