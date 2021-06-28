<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MYCARE SMARTCHOICE</title>
</head>
<body>
    @php
        $reward_name = DB::table('rewards')->where('id',$details['reward_id'])->value('reward_name');
        $detail = DB::table('rewards')->where('id',$details['reward_id'])->value('detail');
    @endphp
    <h1 style="font-family: Mitr !important;">แลกรางวัล {{$reward_name}}</h1>
    <p style="font-family: Mitr !important;">{{$detail}}<br><br>กรุณาติดต่อเพื่อแลกของรางวัล</p>
</body>
</html>