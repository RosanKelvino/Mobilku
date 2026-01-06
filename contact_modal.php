<div id="salesModal" class="sales-modal-overlay" style="display: none;">
    <div class="sales-modal-content glass-panel">
        
        <span class="sales-close-btn" onclick="closeSalesModal()">&times;</span>
        
        <div style="text-align: center; margin-bottom: 25px;">
            <h2 style="margin-bottom: 10px; color: white;">Hubungi Sales</h2>
            <p style="color: rgba(255,255,255,0.6); font-size: 14px;">Siap membantu kebutuhan sewa Anda</p>
        </div>

        <div class="contact-list" style="display: flex; flex-direction: column; gap: 15px;">
            
            <a href="https://wa.me/6281234567890" target="_blank" class="contact-item">
                <div class="icon-box whatsapp-bg">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <div class="text-box">
                    <span>WhatsApp (24 Jam)</span>
                    <strong>+62 812-3456-7890</strong>
                </div>
            </a>

            <a href="tel:+62215555555" class="contact-item">
                <div class="icon-box phone-bg">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div class="text-box">
                    <span>Kantor Pusat</span>
                    <strong>(021) 555-5555</strong>
                </div>
            </a>

            <a href="mailto:sales@mobilku.com" class="contact-item">
                <div class="icon-box email-bg">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="text-box">
                    <span>Email Penawaran</span>
                    <strong>sales@mobilku.com</strong>
                </div>
            </a>
        </div>

        <div class="contact-footer">
            <p><i class="fa-solid fa-location-dot"></i> Jl. Merdeka No. 45, Jakarta Selatan</p>
        </div>
    </div>
</div>

<style>
    .sales-modal-overlay {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.85);
        backdrop-filter: blur(8px);
        z-index: 9999;
        justify-content: center;
        align-items: center;
        animation: fadeIn 0.3s ease;
    }

    .sales-modal-content {
        width: 90%;
        max-width: 400px;
        padding: 30px;
        position: relative;
        background: rgba(255, 255, 255, 0.05); /* Glass Effect */
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
    }

    .sales-close-btn {
        position: absolute;
        top: 15px; right: 20px;
        font-size: 28px;
        color: rgba(255,255,255,0.5);
        cursor: pointer;
        transition: 0.3s;
        line-height: 1;
    }
    .sales-close-btn:hover { color: #ff4d4d; }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px;
        border-radius: 12px;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.05);
        text-decoration: none;
        transition: 0.3s;
    }
    .contact-item:hover {
        background: rgba(255,255,255,0.1);
        transform: translateX(5px);
        border-color: rgba(255,255,255,0.3);
    }

    .icon-box {
        width: 45px; height: 45px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px;
        color: white;
    }
    .whatsapp-bg { background: linear-gradient(135deg, #25D366, #128C7E); }
    .phone-bg { background: linear-gradient(135deg, #4754e6, #2b39cc); }
    .email-bg { background: linear-gradient(135deg, #ffbb00, #ff8800); }

    .text-box { display: flex; flex-direction: column; }
    .text-box span { font-size: 12px; color: rgba(255,255,255,0.6); margin-bottom: 2px; }
    .text-box strong { color: white; font-size: 16px; letter-spacing: 0.5px; }

    .contact-footer {
        margin-top: 25px;
        text-align: center;
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 20px;
    }
    .contact-footer p { font-size: 13px; color: rgba(255,255,255,0.4); }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    .icon-box {
        width: 45px; 
        height: 45px;
        border-radius: 12px;
        
        display: flex; 
        align-items: center;     
        justify-content: center;  
        
        font-size: 22px;
        color: white;
        flex-shrink: 0; 
        line-height: 0; 
    }
    
    .icon-box i {
        display: inline-block;
        vertical-align: middle;
        margin: 0;
        padding: 0;
    }
</style>

<script>
    function openSalesModal() {
        const modal = document.getElementById('salesModal');
        modal.style.display = 'flex';
    }

    function closeSalesModal() {
        const modal = document.getElementById('salesModal');
        modal.style.display = 'none';
    }

    window.addEventListener('click', function(event) {
        const modal = document.getElementById('salesModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
</script>