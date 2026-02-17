import './bootstrap';

import Sortable from 'sortablejs';

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.kanban-column').forEach(column => {
        Sortable.create(column, {
            group: 'kanban',       // allows cards to move between columns
            animation: 150,
            ghostClass: 'opacity-50',
            onEnd(evt) {
                // Send update to Laravel backend when a card is moved
                const cardId = evt.item.dataset.id;
                const newColumn = evt.to.dataset.status;

                fetch(`/tasks/${cardId}/move`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ status: newColumn })
                });
            }
        });
    });
});