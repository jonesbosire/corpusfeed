<footer class="main-footer-gold bg-section dark-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-footer-box-gold">

                    <!-- Footer About -->
                    <div class="footer-about-gold order-1">
                        <div class="footer-logo-gold">
                            @if(!empty($settings['site_logo']))
                                <img src="{{ asset('storage/'.$settings['site_logo']) }}" alt="{{ $settings['site_name'] ?? 'CorpusFeed' }}" style="max-height:50px;">
                            @else
                                <span style="color:#fff;font-size:22px;font-weight:700;">{{ $settings['site_name'] ?? 'CorpusFeed' }}</span>
                            @endif
                        </div>

                        <div class="about-footer-content-gold">
                            <p>{{ $settings['footer_desc'] ?? 'We are dedicated to transforming agriculture through innovation, data-driven insights, and sustainable practices that connect farmers to markets.' }}</p>
                        </div>

                        <div class="footer-social-icons-gold">
                            <ul>
                                @if(!empty($settings['social_facebook']) && $settings['social_facebook'] !== '#')
                                <li><a href="{{ $settings['social_facebook'] }}" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f"></i></a></li>
                                @endif
                                @if(!empty($settings['social_instagram']) && $settings['social_instagram'] !== '#')
                                <li><a href="{{ $settings['social_instagram'] }}" target="_blank" rel="noopener"><i class="fa-brands fa-instagram"></i></a></li>
                                @endif
                                @if(!empty($settings['social_twitter']) && $settings['social_twitter'] !== '#')
                                <li><a href="{{ $settings['social_twitter'] }}" target="_blank" rel="noopener"><i class="fa-brands fa-twitter"></i></a></li>
                                @endif
                                @if(!empty($settings['social_linkedin']) && $settings['social_linkedin'] !== '#')
                                <li><a href="{{ $settings['social_linkedin'] }}" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                @endif
                                @if(!empty($settings['social_youtube']) && $settings['social_youtube'] !== '#')
                                <li><a href="{{ $settings['social_youtube'] }}" target="_blank" rel="noopener"><i class="fa-brands fa-youtube"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <!-- Footer Newsletter -->
                    <div class="footer-newsletter-box-gold order-xl-2 order-3">
                        <h3>Newsletter Signup</h3>
                        <p>Subscribe to receive updates, insights, and tips directly in your inbox.</p>
                        <div class="footer-newsletter-form-gold">
                            <form id="newslettersForm" action="{{ route('newsletter.subscribe') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" id="newsletter-email" placeholder="Enter Your Email" required>
                                    <button type="submit" class="btn-default btn-highlighted">Subscribe</button>
                                </div>
                                <div id="newsletter-msg" style="display:none;margin-top:10px;font-size:14px;"></div>
                            </form>
                        </div>
                    </div>

                    <!-- Footer Links -->
                    <div class="footer-links-box-gold order-xl-3 order-2">
                        <div class="footer-links-gold">
                            <h3>Quick Links</h3>
                            <ul>
                                <li><a href="{{ route('home') }}">Homepage</a></li>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('services.index') }}">Our Services</a></li>
                                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="footer-links-gold">
                            <h3>Company</h3>
                            <ul>
                                <li><a href="{{ route('team') }}">Our Team</a></li>
                                <li><a href="{{ route('faqs') }}">FAQs</a></li>
                                @if(!empty($settings['contact_phone']))
                                <li><a href="tel:{{ $settings['contact_phone'] }}">{{ $settings['contact_phone'] }}</a></li>
                                @endif
                                @if(!empty($settings['contact_email']))
                                <li><a href="mailto:{{ $settings['contact_email'] }}">{{ $settings['contact_email'] }}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-12">
                <div class="footer-copyright-gold">
                    <div class="footer-copyright-text-gold">
                        <p style="font-size:12px;">Copyright &copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'CorpusFeed' }}. All Rights Reserved. &nbsp;|&nbsp; Designed &amp; Developed by <a href="https://eldohub.co.ke" target="_blank" rel="noopener" style="color:var(--accent-color);text-decoration:none;">EldoHub</a></p>
                    </div>
                    <div class="footer-privacy-policy-gold">
                        <ul>
                            <li><a href="{{ route('sitemap') }}">Sitemap</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
(function() {
    var form = document.getElementById('newslettersForm');
    if (!form) return;
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var btn = form.querySelector('button[type="submit"]');
        var msg = document.getElementById('newsletter-msg');
        btn.disabled = true;
        btn.textContent = 'Subscribing...';
        fetch(form.action, {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json'},
            body: new FormData(form)
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            msg.style.display = 'block';
            if (data.success) {
                msg.style.color = '#a8e6a3';
                msg.textContent = data.message || 'Thank you for subscribing!';
                form.querySelector('input[type="email"]').value = '';
                btn.textContent = 'Subscribed!';
            } else {
                msg.style.color = '#f87171';
                msg.textContent = data.message || 'Please try again.';
                btn.disabled = false;
                btn.textContent = 'Subscribe';
            }
        })
        .catch(function() {
            btn.disabled = false;
            btn.textContent = 'Subscribe';
        });
    });
})();
</script>
