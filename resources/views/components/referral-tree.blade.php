@props(['users', 'level' => 1, 'maxLevel' => 5])

@if($users->count() > 0 && $level <= $maxLevel)
<ul class="{{ $level > 1 ? 'pl-6 mt-3 border-l border-white/10 space-y-3' : 'space-y-3' }}">
    @foreach($users as $nodeUser)
    <li>
        <div class="flex items-center justify-between p-3 rounded-xl border border-white/5 bg-white/[0.02] hover:bg-white/[0.05] transition-colors {{ $nodeUser->nestedChildren->count() > 0 && $level < $maxLevel ? 'cursor-pointer' : '' }}"
             @if($nodeUser->nestedChildren->count() > 0 && $level < $maxLevel) onclick="toggleReferralTree('tree-node-{{ $nodeUser->id }}')" @endif>
            
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-brand-purple/20 to-brand-pink/10 border border-brand-purple/30 flex items-center justify-center text-sm font-serif text-white">
                    {{ strtoupper(substr($nodeUser->name, 0, 2)) }}
                </div>
                <div>
                    <div class="text-sm text-white font-medium flex items-center gap-2">
                        {{ $nodeUser->name }}
                        @if($nodeUser->status === 'active')
                            <span class="w-2 h-2 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.5)]" title="Active"></span>
                        @else
                            <span class="w-2 h-2 rounded-full bg-amber-400 shadow-[0_0_8px_rgba(251,191,36,0.5)]" title="Pending"></span>
                        @endif
                    </div>
                    <div class="text-xs text-gray-400 font-mono mt-0.5">ID: {{ $nodeUser->user_id }} &bull; Level {{ $level }}</div>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <span class="text-xs font-medium text-brand-pink block">{{ $nodeUser->nestedChildren->count() }}</span>
                    <span class="text-[10px] uppercase tracking-widest text-gray-500">Referrals</span>
                </div>
                
                @if($nodeUser->nestedChildren->count() > 0 && $level < $maxLevel)
                <div class="w-6 h-6 rounded-full bg-white/5 flex items-center justify-center">
                    <svg id="icon-tree-node-{{ $nodeUser->id }}" class="w-4 h-4 text-gray-400 transition-transform transform rotate-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
                @endif
            </div>
        </div>

        @if($nodeUser->nestedChildren->count() > 0 && $level < $maxLevel)
        <div id="tree-node-{{ $nodeUser->id }}" class="hidden overflow-hidden transition-all duration-300">
            <x-referral-tree :users="$nodeUser->nestedChildren" :level="$level + 1" :maxLevel="$maxLevel" />
        </div>
        @endif
    </li>
    @endforeach
</ul>
@endif
