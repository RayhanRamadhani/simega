@extends('layouts.app')
@section('content')
<body>
  <div class="grid-rows-none bg-slate-200">

    <!-- Header -->
    <div class="flex bg-slate-500 pb-4">
      <img class="flex max-w-28 rounded-full mr-4" src="/images/roki_avatar.png" alt="roki_vatar">
      <div class="flex-auto content-center grid-rows-2 align-middle bg-red-950">
        <h1 class="text-3xl bg-green-500 p4">Roki</h1>
        <small class="flex bg-red-500 p4">Online</small>
      </div>
    </div>

    <!-- Chat -->
    <div class="flex col-auto bg-blue-500">
        <img class="flex max-w-14 rounded-full mr-4" src="/images/roki_avatar.png" alt="Avatar">
        <p class="flex rounded-full bg-slate-100 p-4">Hai! butuh bantuan untuk rancangan tugas? tanya Roki aja sini!</p>
    </div>

    <!-- Footer chat -->
    <div class="bottom">
      <form>
        <input type="text" id="message" name="message" placeholder="Ketik pesan..." autocomplete="off">
        <button type="submit">Kirim</button>
      </form>
    </div>

  </div>
</body>

<script>
  //Submit
  $("form").submit(function (event) {
    event.preventDefault();

    if ($("form #message").val().trim() === '') {
      return;
    }

    //Disable submit sementara
    $("form #message").prop('disabled', true);
    $("form button").prop('disabled', true);

    $.ajax({
      url: "/chatbot",
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
      },
      data: {
        "content": $("form #message").val()
      }
    }).done(function (res) {

      //Kirim pesan
      $(".messages > .message").last().after('<div class="right message">' +
        '<p>' + $("form #message").val() + '</p>' +
        '</div>');

      //Terima pesan
      $(".messages > .message").last().after('<div class="left message">' +
        '<img src="/images/roki_avatar.png" alt="Roki vatar" width="60px">' +
        '<p>' + res + '</p>' +
        '</div>');

      //Cleanup
      $("form #message").val('');
      $(document).scrollTop($(document).height());

      //Enable form
      $("form #message").prop('disabled', false);
      $("form button").prop('disabled', false);
    });
  });

</script>
@endsection