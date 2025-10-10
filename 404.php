   <style>
       .ascii-mail-container {
           overflow-x: auto;
           /*background-color: #222;*/
           border-radius: 0.5rem;
           padding: 1rem;
           margin: 0.5rem 0;
       }
       
       .ascii-mail-container pre {
           font-size: 6px;
           font-weight: bold;
           text-shadow: 
                1px 0 0 currentColor,      
               -1px 0 0 currentColor,     
               0 1px 0 currentColor,      
               0 -1px 0 currentColor;              
           /*color: #00ff00;*/
           line-height: 1.1;
           white-space: pre;
           letter-spacing: 0;
           word-spacing: 0;
           margin: 0;
           padding: 0;
       }
       
       }
   </style>

<?php get_header(); ?>
<main class="container mx-auto px-4 py-8 max-w-4xl">
    <article class="relative bg-white rounded-lg shadow-lg p-8 mb-12 overflow-hidden">
            <h1 class="text-3xl font-bold mb-6">404 Not Found</h1>
            <p class="text-gray-600 mb-8">お探しのページは存在しないか、移動した可能性があります。</p>
        <div class="ascii-mail-container">
            <pre>
                   _ov
             .,HH'            #o
            ?&MM?.,oooo__     `MH\
           |R6M&RMH&9MMMMHb.  ,MMM|
           |6MHMGHMHMM&M9MH6HMHHMM}
            MHMHMHMH6MH6MRMHMMHMP'
           iHSD6HMHMHH&MHMMMMMH'
          oMHMMHMMHM$RM9MHM9M?'
     -v_ |9&RHRMMHMHMHH96MMMM!
    \_ "\:HHHDM9H&M&kM&6HMHMH
 .  `"qod' `?*MH&R6M6MRMMMH'
 `+&oo$PHbd##|``H9HHHMHHM!
         H9HMb\_d9MHH6M9M?
         #&MHM9M&HH&MMHHMM,
          "^*HHRM96M&M9MMML
             `MRHMHHMMMRMM?
             ,RMHHMMMHMMMM,
              H&RM&6MHMMHMk
               HMHMH6MHMMMMb_
              _H&H96RMR6M[*MM#o\_
    ,/:-:)&9&*#MH9HHMHHHM    **HHHH#o\_.
     ?:\?d?_:/v?ZMHHHHRMM9D           *HH#.
          -\|?\RM&&##+*            .db MMHMF
                               oo#HMHMMMMM?
                                </pre>

        </div>
    </article>
</main>

<?php get_footer(); ?>
