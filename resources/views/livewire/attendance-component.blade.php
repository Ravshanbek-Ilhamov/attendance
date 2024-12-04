<div>

    <input 
    class="form-control m-3" 
    type="date" 
    wire:change="findTheDate" 
    wire:model="date" 
    style="width: 200px; font-size: 14px;">

    <h4 class="mr-3" style="color: darkgreen">{{$monthName}} {{$year}}</h4>

    @php
    
        // dd($daysInMonth,$monthName,$year,$students,$days->year);

    @endphp
    <table class="table table-bordered table-striped mt-5">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            @foreach ($days as $day)
                <th>{{$day->format('d')}}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @foreach ($students as $student)
              <tr>
                  <th scope="row">{{ $student->id }}</th>
                  <td>{{ $student->name }}</td>
                  
                  @foreach ($days as $day)
                        @php
                            $userattend = $student->checks($day->format('Y-m-d'));
                        @endphp
                        <td wire:click="inputView('{{$student->id}}','{{$day->format('Y-m-d')}}')"> 
                            @if ($studentID == $student->id && $attendance_date == $day->format('Y-m-d'))

                            <input type="text" style="width: 30px; border-radius:5px" autofocus value="{{$userattend->status ?? ''}}"
                                wire:keydown.enter="saveTheResult('{{$student->id}}','{{$day->format('Y-m-d')}}', $event.target.value)">           
                            @else
                                @if ($userattend)
                                    <span class="text-{{$userattend->status == '+' ? 'primary' : 'danger'}}">
                                        {{$userattend->status}}
                                    </span>
                                @endif
                            @endif      
                        </td>
                  @endforeach
              </tr>
          @endforeach
      </tbody>
      
      </table>

</div>
