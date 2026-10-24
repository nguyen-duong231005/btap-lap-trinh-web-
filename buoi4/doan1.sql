SELECT 
    s.id AS sach_id, 
    s.ten_sach, 
    GROUP_CONCAT(t.ten SEPARATOR ', ') AS tac_gia, 
    COUNT(pm.id) AS so_luot_muon
FROM phieu_muon pm
JOIN ban_sao b ON pm.ban_sao_id = b.id
JOIN sach s ON b.sach_id = s.id
LEFT JOIN sach_tac_gia stg ON s.id = stg.sach_id
LEFT JOIN tac_gia t ON stg.tac_gia_id = t.id
GROUP BY s.id, s.ten_sach
ORDER BY so_luot_muon DESC
LIMIT 5;