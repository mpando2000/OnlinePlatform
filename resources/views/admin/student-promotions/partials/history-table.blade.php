<section class="table-card">
    <div class="table-title">
        <strong>History</strong>
        <span>{{ $promotions->count() }} records</span>
    </div>
    <div class="table-responsive">
        <table class="clean-table">
            <thead><tr><th>Student</th><th>From</th><th>To</th><th>Date</th><th class="text-right">Action</th></tr></thead>
            <tbody>
                @forelse($promotions as $promotion)
                    <tr>
                        <td><strong>{{ optional($promotion->student)->firstname }} {{ optional($promotion->student)->lastname }}</strong></td>
                        <td>{{ optional($promotion->fromClass)->name ?? 'N/A' }}<span>{{ $promotion->from_academic_year }}</span></td>
                        <td>{{ optional($promotion->toClass)->name ?? 'N/A' }}<span>{{ $promotion->to_academic_year }}</span></td>
                        <td>{{ $promotion->promoted_at ? $promotion->promoted_at->format('M j, Y') : 'N/A' }}</td>
                        <td>
                            <div class="row-actions">
                                @if($promotion->student)
                                    <a href="{{ route('admin.promotions.student-history', $promotion->student) }}" class="icon-btn"><i class="fas fa-user"></i></a>
                                @endif
                                <form action="{{ route('admin.promotions.undo', $promotion) }}" method="POST" onsubmit="return confirm('Undo this promotion?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="icon-btn danger" type="submit"><i class="fas fa-undo"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty-cell">No promotion history found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(method_exists($promotions, 'links'))
        <div class="pagination-wrap">{{ $promotions->links() }}</div>
    @endif
</section>
