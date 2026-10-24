SELECT 
    nd.id AS nguoi_dung_id,
    nd.ho_ten, 
    nd.email, 
    nd.so_dien_thoai, 
    s.ten_sach, 
    pm.han_tra,
    DATEDIFF(CURDATE(), pm.han_tra) AS so_ngay_qua_han
FROM phieu_muon pm
JOIN nguoi_dung nd ON pm.nguoi_dung_id = nd.id
JOIN ban_sao b ON pm.ban_sao_id = b.id
JOIN sach s ON b.sach_id = s.id
WHERE pm.tinh_trang_tra = 'dang_muon' AND pm.han_tra < CURDATE();