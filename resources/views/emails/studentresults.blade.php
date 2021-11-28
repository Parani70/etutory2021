

<p>Hi {{$data['studentname']}}</p>
<h4>Congratulations on completing the exam for {{$data['examname']}}</h4>

<p>Please find the exam results below.</p>

@if(count($data['examseatdata']) > 0)

<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>Question Type</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Marks</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i=1;
        
        @endphp
        @foreach($data['examseatdata']->all() as $examres)

        @if($examres->questiontype == 'ESSAY' | $examres->questiontype == 'SHORT')

        <tr>
            <td>{{$i}}</td>
            <td>{{$examres->questiontype}}</td>
            <td>{!!$examres->questionheader!!}</td>
            <td></td>
            <td>Pending Marks</td>
        </tr>


        @else

        <tr>
            <td>{{$i}}</td>
            <td>{{$examres->questiontype}}</td>
            <td>{!!$examres->questionheader!!}</td>
            @if($examres->correct == 'true')
            <td>RIGHT</td>
            @else
            <td>WRONG</td>
            @endif
         
            <td style="text-align: right;">{{$examres->marks}}</td>
        </tr>


        @endif
        
        @php
        $i++;
        @endphp

        @endforeach
        <tr>
            <td colspan="4"><b>TOTAL:</b></td>
            <td style="text-align: right;">{{$data['totalmarks']}}</td>
        </tr>
    </tbody>
</table>

@endif

<p>With Best wishes</p>
<p>From</p>
<p>eTutory Team</p>

 


