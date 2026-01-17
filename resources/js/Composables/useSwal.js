import Swal from "sweetalert2";

export function useSwal() {
    const success = (text, title = "Berhasil") => {
        return Swal.fire({
            icon: "success",
            title,
            text,
            confirmButtonText: "OK",
        });
    };

    const error = (text, title = "Gagal") => {
        return Swal.fire({
            icon: "error",
            title,
            text,
            confirmButtonText: "OK",
        });
    };

    const info = (text, title = "Informasi") => {
        return Swal.fire({
            icon: "info",
            title,
            text,
            confirmButtonText: "OK",
        });
    };

    const confirm = (text, title = "Konfirmasi") => {
        return Swal.fire({
            icon: "warning",
            title,
            text,
            showCancelButton: true,
            confirmButtonText: "Ya",
            cancelButtonText: "Batal",
            reverseButtons: true,
        });
    };

    return {
        success,
        error,
        info,
        confirm,
    };
}
