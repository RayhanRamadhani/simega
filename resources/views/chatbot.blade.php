@extends('layouts.app')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
  <div class="container flex flex-col h-screen">

    <div class="flex justify-left items-center">
      <img src="{{ asset('images/roki.png') }}" alt="Maskot" class="w-32 h-30">
      <div class="ml-4 text-left">
          <h1 class="text-5xl font-bold">Hai,</h1>
          <h2 class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-blue-500">{{ Auth::user()->firstname }}!</h2>
          <p class="text-gray-600 text-lg">Butuh bantuan? tanya Roki yuk!</p>
      </div>
    </div>

    <div class="messages flex-grow p-4 overflow-y-auto">
      <div class="left message flex mb-4">
        <img class="w-10 h-10 rounded-full mr-2 self-end" src="/images/roki_avatar.png" alt="Avatar">
        <p class="flex bg-gray-300 rounded-lg p-3 max-w-xs">Hai! Butuh bantuan untuk rancangan tugas? Tanya Roki aja sini!</p>
      </div>
    </div>

    <div class="p-1 bg-white border-t sticky bottom-0 z-20">
      <form class="flex gap-2">
        <input type="text" id="message" name="message" 
               class="flex-grow border rounded-full px-4 py-2" 
               placeholder="Ketik pesan..." autocomplete="off">
        <button type="submit" 
                class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600">
          Kirim
        </button>
      </form>
    </div>
  </div>

<script>
  $(document).ready(function() {
    $("form").submit(function(event) {
      event.preventDefault();
      
      const messageText = $("#message").val().trim();
      if (messageText === '') {
        return;
      }

      $("#message").prop('disabled', true);
      $("form button").prop('disabled', true);
      
      $(".messages").append(
        '<div class="right message flex justify-end mb-4">' +
        '<p class="bg-blue-300 rounded-lg p-3 max-w-xs">' + messageText + '</p>' +
        '</div>'
      );
      
      $(".messages").scrollTop($(".messages")[0].scrollHeight);
      
      $.ajax({
        url: "/chatbot",
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': "{{csrf_token()}}"
        },
        data: {
          "content": messageText
        }
      }).done(function(res) {
        const formattedResponse = marked.parse(res);
        
        $(".messages").append(
          '<div class="left message flex mb-4">' +
          '<img src="/images/roki_avatar.png" alt="Roki avatar" class="w-10 h-10 rounded-full mr-2 self-start">' + 
          '<div class="chat-bubble bg-gray-300 rounded-lg p-3 markdown-content">' + formattedResponse + '</div>' +
          '</div>'
        );
        
        $(".messages").scrollTop($(".messages")[0].scrollHeight);
        
      }).fail(function(error) {
        $(".messages").append(
          '<div class="left message flex mb-4">' +
          '<img src="/images/roki_avatar.png" alt="Roki avatar" class="w-10 h-10 rounded-full mr-2 self-end">' +
          '<p class="bg-red-100 rounded-lg p-3 max-w-xs">Maaf, ada kesalahan teknis.</p>' +
          '</div>'
        );
        console.error("Error:", error);
        
      }).always(function() {
        $("#message").prop('disabled', false);
        $("form button").prop('disabled', false);
        $("#message").val('').focus();
      });
    });
  });
</script>
@endsection