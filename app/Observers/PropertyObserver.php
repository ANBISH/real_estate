<?php

namespace App\Observers;

use App\Models\Property;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PropertyObserver
{
    /**
     * Handle the Property "created" event.
     */
    public function created(Property $property): void
    {
        $property->id = Str::uuid();

        if (empty($property->status_id)) {
            $property->status_id = 'draft';
        }
    }

    public function updating(Property $property): void
    {
        if (
            auth()->check() &&
            auth()->user()->hasRole('admin') &&
            $property->isDirty('status_id')
        ) {
            if ($property->status_id === 'draft') {
                $property->approved = false;
            } else {
                $property->approved = true;
                $property->approved_at = Carbon::now();
            }
        }
    }

    /**
     * Handle the Property "updated" event.
     */
    public function updated(Property $property): void {}

    /**
     * Handle the Property "deleted" event.
     */
    public function deleted(Property $property): void
    {
        //
    }

    /**
     * Handle the Property "restored" event.
     */
    public function restored(Property $property): void
    {
        //
    }

    /**
     * Handle the Property "force deleted" event.
     */
    public function forceDeleted(Property $property): void
    {
        //
    }
}
