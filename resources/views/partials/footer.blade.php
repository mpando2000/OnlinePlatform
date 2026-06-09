<x-layout />

<style>
.footer {
    background: linear-gradient(135deg, #1e3a5f 0%, #28a745 100%);
    color: white;
    padding: 60px 0 30px 0;
    margin-top: 80px;
    position: relative;
    overflow: hidden;
}

.footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: #28a745;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.footer h4 {
    font-weight: 700;
    margin-bottom: 25px;
    position: relative;
    color: #fff;
    font-size: 1.4rem;
}

.footer h4::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 50px;
    height: 3px;
    background: #28a745;
    border-radius: 2px;
}

.footer-item {
    background: rgba(255, 255, 255, 0.1);
    padding: 30px;
    border-radius: 15px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    height: 100%;
}

.footer-item:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.footer-item p {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    font-size: 1rem;
    line-height: 1.6;
    color: #fff;
}

.footer-item i {
    font-size: 1.2rem;
    margin-right: 15px;
    color: #28a745;
    width: 30px;
    height: 30px;
    text-align: center;
    background: rgba(40, 167, 69, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.footer-item:hover i {
    background: rgba(40, 167, 69, 0.4);
    transform: scale(1.1);
}

.footer-item a {
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
}

.footer-item a:hover {
    color: #28a745;
    text-decoration: underline;
    text-underline-offset: 4px;
}

.footer-divider {
    margin: 40px 0 20px 0;
    border: none;
    height: 1px;
    background: rgba(255, 255, 255, 0.3);
}

.footer-bottom {
    text-align: center;
    padding-top: 20px;
    font-size: 0.9rem;
    opacity: 0.9;
    color: #fff;
}

@media (max-width: 768px) {
    .footer {
        padding: 40px 0 20px 0;
    }
    
    .footer-item {
        padding: 25px 20px;
        margin-bottom: 20px;
    }
    
    .footer h4 {
        font-size: 1.2rem;
        text-align: center;
    }
    
    .footer h4::after {
        left: 50%;
        transform: translateX(-50%);
    }
    
    .footer-item p {
        justify-content: center;
        text-align: center;
    }
    
    .footer-container {
        padding: 0 15px;
    }
}
</style>

<footer class="footer">
    <div class="footer-container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="footer-item">
                    <h4>Quick Links</h4>
                    <p>
                        <i class="fa fa-external-link-alt"></i>
                        <a href="https://sumajkt.go.tz" target="_blank">Visit Our Official Website</a>
                    </p>
                    <p>
                        <i class="fa fa-home"></i>
                        <span>E-Learning Platform Portal</span>
                    </p>
                    <p>
                        <i class="fa fa-graduation-cap"></i>
                        <span>Student Management System</span>
                    </p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="footer-item">
                    <h4>Contact Information</h4>
                    <p>
                        <i class="fa fa-phone"></i>
                        <a href="tel:+255222780934">+255 222 780 934</a>
                    </p>
                    <p>
                        <i class="fa fa-mobile-alt"></i>
                        <a href="tel:+255713411223">+255 713 411 223</a>
                    </p>
                    <p>
                        <i class="fa fa-envelope"></i>
                        <a href="mailto:info@suma.go.tz">info@sumajkt.go.tz</a>
                    </p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-12">
                <div class="footer-item">
                    <h4>Our Location</h4>
                    <p>
                        <i class="fa fa-map-marker-alt"></i>
                        <span>Barabara ya Mwai Kibaki</span>
                    </p>
                    <p>
                        <i class="fa fa-building"></i>
                        <span>Mlalakuwa, P.O. Box 1694</span>
                    </p>
                    <p>
                        <i class="fa fa-city"></i>
                        <span>Dar-es-Salaam, Tanzania</span>
                    </p>
                </div>
            </div>
        </div>
        
        <hr class="footer-divider">
        
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} TPDF E-Learning Platform. All rights reserved.</p>
            <p style="margin-top: 10px; font-size: 0.8rem; opacity: 0.8;">Empowering Learners For The Future</p>
        </div>
    </div>
</footer>