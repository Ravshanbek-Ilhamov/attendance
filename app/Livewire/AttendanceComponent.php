<?php

namespace App\Livewire;

use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AttendanceComponent extends Component
{
    public $date; // Selected date
    public $fullDate; // Selected date
    public $monthName; // Name of the month
    public $day; // Day of the month
    public $days = []; // Day of the month
    public $year; // Year
    public $daysInMonth; // Total days in the month
    public $students; // List of students
    public $result;
    public $studentID;
    public $attendance_date;
    public $attendance;
    // Called when the component is initialized
    public function mount()
    {
        $now = Carbon::now('Asia/Tashkent'); 
        
        $this->fullDate = $now; // The full Carbon instance
        $this->date = $now->toDateString(); // "2024-12-03" as a string in the 'Y-m-d' format
        $this->monthName = $now->format('F'); // "December" (current month name)
        $this->year = $now->year; 
        $this->daysInMonth = $now->daysInMonth; 
    }

    public function render()
    {              
        $this->students = Student::all();
        $parsedDate = Carbon::parse($this->date); 
        
        for ($i = 1; $i <= $this->daysInMonth; $i++) { // Use <= to include the last day
            $this->days[] = Carbon::create($parsedDate->year, $parsedDate->month, $i);
        }   
        return view('livewire.attendance-component');
    }

    public function findTheDate()
    {
        if ($this->date) {
            $parsedDate = Carbon::parse($this->date); 
            $this->monthName = $parsedDate->format('F');
            $this->year = $parsedDate->year;
            $this->daysInMonth = $parsedDate->daysInMonth; 
        }
    }
    // public $results = []; 

    public function saveTheResult(Student $student, $date,$value)
    {
        $student->attendance()->updateOrCreate(
            ['date' => Carbon::parse($date)],
            ['status' => $value],
        );
        
        $this->reset(['studentID','attendance_date']);

    }

    public function inputView($id,$date){
        $this->studentID = $id;
        $this->attendance_date = $date;
    }


}
