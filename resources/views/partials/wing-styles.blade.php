<style>
/* Modern Premium Wing Member Card */
.premium-wing-section {
    padding: 80px 0;
    background-color: #f8f9fc;
}

.wing-grid-modern {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 40px;
    max-width: 1320px;
    margin: 0 auto;
    padding: 0 20px;
}

.member-card-modern {
    background: #ffffff;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(226, 232, 240, 0.5);
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    position: relative;
    text-align: center;
    padding: 40px 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
    z-index: 1;
}

.member-card-modern::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 130px;
    background: linear-gradient(135deg, #e36108 0%, #ff8c42 100%);
    z-index: -1;
    border-radius: 24px 24px 0 0;
    transition: all 0.4s ease;
}

.member-card-modern:hover {
    transform: translateY(-12px);
    box-shadow: 0 25px 50px rgba(227, 97, 8, 0.15);
}

.member-avatar-wrapper {
    position: relative;
    width: 160px;
    height: 160px;
    margin: 0 auto 25px;
    z-index: 2;
}

.member-avatar-inner {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    overflow: hidden;
    background: #fff;
    padding: 6px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.member-avatar-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    display: block;
}

.member-placeholder {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
}

.member-name-modern {
    font-size: 24px;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 10px;
    font-family: 'Outfit', sans-serif;
}

.member-badge-modern {
    background: rgba(227, 97, 8, 0.1);
    color: #e36108;
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 20px;
    display: inline-block;
}

.member-short-desc {
    color: #64748b;
    font-size: 15px;
    line-height: 1.7;
    margin-bottom: 25px;
    flex-grow: 1;
}

.member-divider {
    width: 40px;
    height: 4px;
    background: #e2e8f0;
    margin: 0 auto 25px;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.member-card-modern:hover .member-divider {
    background: #e36108;
    width: 80px;
}

.member-contact-modern {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.contact-item-modern {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    color: #475569;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    background: #f8fafc;
    padding: 12px 20px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.contact-item-modern i {
    color: #e36108;
    font-size: 16px;
    transition: transform 0.3s ease;
}

.contact-item-modern:hover {
    background: #e36108;
    color: #fff;
    border-color: #e36108;
    text-decoration: none;
}

.contact-item-modern:hover i {
    color: #fff;
    transform: scale(1.2);
}
</style>
