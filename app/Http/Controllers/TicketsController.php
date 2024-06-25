<?php

namespace App\Http\Controllers;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Http\Requests\Tickets\CreateTicketRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get Priority and status filter options
        $priorities = TicketPriority::toSelectArray();
        $statuses = TicketStatus::toSelectArray();

        // Get default 10 items if per_page parameter is empty
        $perPage = $request->input('per_page') ?? 10;

        // Filters query params
        $filters = $request->only([
            'searchInput', 'status', 'priority', 'date'
        ]);

        // If search input is provided, Laravel Scout used to search
        if ($filters['searchInput'] ?? false) {

            $searchQuery = Ticket::search($filters['searchInput'])->query(function ($query) {
                $query->join('users', 'tickets.user_id', '=', 'users.id');
            });
            $searchResults = $searchQuery->get()->pluck('id');
        }

        $tickets = Ticket::with('user')
            ->when(
                $filters['priority'] ?? false,
                fn ($query, $value) => $query->where('priority', $value)
            )
            ->when(
                $filters['status'] ?? false,
                fn ($query, $value) => $query->where('status', $value)
            )
            ->when(
                $filters['date'] ?? false,
                fn ($query, $value) => $query->whereBetween('created_at', $value)
            )
            ->when(
                $searchResults ?? false,
                fn ($query, $value) => $query->whereIn('id', $value)
            )
            ->paginate($perPage)->withQueryString();

        return inertia('Tickets/Index', [
            'tickets' => $tickets,
            'priorities' => $priorities,
            'statuses' => $statuses,
            'filters' => $filters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $priorities = TicketPriority::toSelectArray();
        $statuses = TicketStatus::toSelectArray();

        return inertia('Tickets/CreateTicket', [
            'priorities' => $priorities,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTicketRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();

        Ticket::create($data);

        return redirect()->route('tickets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::with('user', 'responses')->findOrFail($id);
        return inertia('Tickets/Show', [
            'ticket' => $ticket,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('tickets.index');
    }
}
