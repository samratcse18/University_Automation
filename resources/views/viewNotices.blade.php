@extends('layouts.Dashboard')

@section('content')
    @php
        use App\Models\HallCircular;
        $user = Auth::guard('admin')->user();
        if ($user) {
            $notice = HallCircular::where('dept', $user->dept)
                ->orderBy('created_at', 'desc')
                ->get();
            $circular = HallCircular::all();
        } else {
            $notice = HallCircular::where('dept', Auth::guard('student')->user()->dept)
                ->orderBy('created_at', 'desc')
                ->get();
            $circular = HallCircular::all();
        }
    @endphp
    <div class="text-[20px] font-bold">List of Notices</div>
    <div class="mb-6 h-[2px] w-full bg-[#006666]"></div>
    @cannot('student.dashboard')
        @foreach ($circular as $item)
            @if (!empty($item->hall_name) && empty($item->dept) && ($item->type == 'Circular' || $item->type == 'Interview'))
                <div class="text-left"><a href="{{ route('admin.circularView', ['id' => $item->id]) }}"
                        target="blank">{{ $item->hall_name }} Circular</a></div>
            @endif
        @endforeach
        @foreach ($notice as $item2)
            @if ($user && $item2->dept == $user->dept && ($item2->type == 'Circular' || $item2->type == 'Interview'))
                <div class="text-left"><a href="{{ route('admin.circularView', ['id' => $item2->id]) }}"
                        target="blank">{{ date('d/m/Y', strtotime($item2->created_at)) }}: {{ $item2->dept }}
                        Circular</a></div>
            @endif
        @endforeach
    @endcannot
    @can('student.dashboard')
        @foreach ($notice as $item2)
            @if ($item2->dept == Auth::guard('student')->user()->dept && $item2->type == 'Student')
                <div class="text-left"><a href="{{ route('student.circularView', ['id' => $item2->id]) }}"
                        target="blank">{{ date('d/m/Y', strtotime($item2->created_at)) }}: {{ $item2->dept }}
                        Circular</a></div>
            @endif
        @endforeach
    @endcan
@endsection
