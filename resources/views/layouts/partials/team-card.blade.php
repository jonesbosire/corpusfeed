<div class="wow fadeInUp" data-wow-delay="{{ $delay ?? 0 }}s"
     style="background:#fff; border-radius:16px; box-shadow:0 4px 24px rgba(0,0,0,0.07); overflow:hidden; transition:transform 0.3s ease, box-shadow 0.3s ease;"
     onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 12px 36px rgba(0,0,0,0.13)'"
     onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 24px rgba(0,0,0,0.07)'">

    {{-- Full-width image at top --}}
    <div style="width:100%; height:240px; overflow:hidden; position:relative;">
        @if($member->photo)
            <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}"
                 style="width:100%; height:100%; object-fit:cover; object-position:top; display:block; transition:transform 0.4s ease;"
                 onmouseover="this.style.transform='scale(1.05)'"
                 onmouseout="this.style.transform='scale(1)'">
        @else
            <div style="width:100%; height:100%; background:linear-gradient(135deg,#2d6a4f,#52b788); display:flex; align-items:center; justify-content:center;">
                <span style="color:#fff; font-size:64px; font-weight:700; line-height:1; opacity:0.9;">{{ strtoupper(substr($member->name,0,1)) }}</span>
            </div>
        @endif
    </div>

    {{-- Card body --}}
    <div style="padding:20px 20px 18px; text-align:center;">
        <h3 style="margin:0 0 5px; font-size:17px; font-weight:700; color:#1a1a1a;">{{ $member->name }}</h3>
        <p style="margin:0 0 14px; font-size:12px; font-weight:600; color:#2d6a4f; text-transform:uppercase; letter-spacing:0.6px;">{{ $member->role }}</p>

        {{-- Social Icons --}}
        @if($member->linkedin || $member->twitter || $member->email)
        <div style="display:flex; justify-content:center; gap:8px;">
            @if($member->linkedin)
            <a href="{{ $member->linkedin }}" target="_blank"
               style="width:32px;height:32px;border-radius:50%;border:1px solid #e0e0e0;display:inline-flex;align-items:center;justify-content:center;color:#555;font-size:13px;text-decoration:none;transition:all 0.2s;"
               onmouseover="this.style.background='#2d6a4f';this.style.borderColor='#2d6a4f';this.style.color='#fff'"
               onmouseout="this.style.background='transparent';this.style.borderColor='#e0e0e0';this.style.color='#555'">
                <i class="fa-brands fa-linkedin-in"></i>
            </a>
            @endif
            @if($member->twitter)
            <a href="{{ $member->twitter }}" target="_blank"
               style="width:32px;height:32px;border-radius:50%;border:1px solid #e0e0e0;display:inline-flex;align-items:center;justify-content:center;color:#555;font-size:13px;text-decoration:none;transition:all 0.2s;"
               onmouseover="this.style.background='#2d6a4f';this.style.borderColor='#2d6a4f';this.style.color='#fff'"
               onmouseout="this.style.background='transparent';this.style.borderColor='#e0e0e0';this.style.color='#555'">
                <i class="fa-brands fa-twitter"></i>
            </a>
            @endif
            @if($member->email)
            <a href="mailto:{{ $member->email }}"
               style="width:32px;height:32px;border-radius:50%;border:1px solid #e0e0e0;display:inline-flex;align-items:center;justify-content:center;color:#555;font-size:13px;text-decoration:none;transition:all 0.2s;"
               onmouseover="this.style.background='#2d6a4f';this.style.borderColor='#2d6a4f';this.style.color='#fff'"
               onmouseout="this.style.background='transparent';this.style.borderColor='#e0e0e0';this.style.color='#555'">
                <i class="fa-solid fa-envelope"></i>
            </a>
            @endif
        </div>
        @endif
    </div>
</div>
