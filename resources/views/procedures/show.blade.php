 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procedure Details</title>
    <link rel="stylesheet" href="{{ asset('assets/css/showItem.css')}}">
 </head>
 <body>
 <div class="list">
 @foreach($procedureDetails as $procedureName => $processList)
  <h2>{{ $procedureName }}</h2>
  @if($processList->count())
  <ul>
  @foreach($processList as $processItem)
    <li><span>{{ $processItem->process_name }}-{{ $processItem->dept_name }}</span> <span class="tooltip-text" id="fade">{{ $processItem->description }}</span></li>
    @endforeach	
  </ul>
  @else
            <p>No process found for this procedure.</p>
        @endif
        @endforeach 
</div>
   



