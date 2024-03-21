import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";

export default function useBase() {
    const success = computed({get: () => usePage().props.success, set: () => usePage().props.success = null});
    const error = computed({get: () => usePage().props.error, set: () => usePage().props.error = null});

    return {
        error,
        success,
    };
}
