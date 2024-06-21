export function formatDateTime(date) {
    let hours = date.getHours().toString().padStart(2, '0');
    let minutes = date.getMinutes().toString().padStart(2, '0');
    let seconds = date.getSeconds().toString().padStart(2, '0');
    let day = date.getDate().toString().padStart(2, '0');
    let month = (date.getMonth() + 1).toString().padStart(2, '0'); // Tháng trong JavaScript bắt đầu từ 0
    let year = date.getFullYear();
    return `${hours}:${minutes}:${seconds} ${day}:${month}:${year}`;
}

export function formatPrice(price) {
    if (price == null) return;
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}