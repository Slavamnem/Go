<?php

namespace App\Project\Storage\Copies;

use App\Kernel\Classes\PdoHelper;

class DatabaseCopy2019_02_23_17_44_46
{
    const TRIES_LIMIT = 500;

    public static $pdo;
    public static $insertDataSqls = array (
  0 => 'INSERT INTO __likes VALUES(\'1\', \'1\', \'2\'), (\'2\', \'1\', \'3\'), (\'3\', \'2\', \'1\')',
  1 => 'INSERT INTO __posts VALUES(\'1\', \'box\', \'loma wins again!\', \'1\'), (\'2\', \'boxing\', \'usuk win!\', \'1\'), (\'3\', \'footbal\', \'dinamo plays again\', \'2\'), (\'4\', \'dance\', \'ama dancer ama ma dancer!\', \'2\'), (\'5\', \'nature\', \'birds fly!!\', \'3\'), (\'6\', \'test\', \'test text\', NULL), (\'7\', \'tt\', \'text\', NULL), (\'8\', \'tt\', \'text\', NULL), (\'9\', \'tt\', \'text\', \'1\'), (\'10\', \'tt\', \'text\', \'1\'), (\'11\', \'tt\', \'text\', \'1\'), (\'12\', \'3\', \'4\', NULL), (\'13\', \'3\', \'4\', NULL), (\'14\', \'3\', \'4\', NULL), (\'15\', \'33\', \'44\', NULL), (\'16\', \'333\', \'444\', NULL), (\'17\', \'777777\', \'77777\', NULL), (\'18\', \'3\', \'4\', NULL), (\'19\', \'33\', \'44\', NULL), (\'20\', \'333\', \'444\', NULL), (\'21\', \'777777\', \'77777\', NULL), (\'22\', \'3\', \'4\', NULL), (\'23\', \'33\', \'44\', NULL), (\'24\', \'333\', \'444\', NULL), (\'25\', \'777777\', \'77777\', NULL), (\'26\', \'3\', \'4\', NULL), (\'27\', \'33\', \'44\', NULL), (\'28\', \'333\', \'444\', NULL), (\'29\', \'777777\', \'77777\', NULL), (\'30\', \'3\', \'4\', NULL), (\'31\', \'33\', \'44\', NULL), (\'32\', \'333\', \'444\', NULL), (\'33\', \'777777\', \'77777\', NULL), (\'34\', \'3\', \'4\', NULL), (\'35\', \'33\', \'44\', NULL), (\'36\', \'333\', \'444\', NULL), (\'37\', \'777777\', \'77777\', NULL), (\'38\', \'3\', \'4\', NULL), (\'39\', \'33\', \'44\', NULL), (\'40\', \'333\', \'444\', NULL), (\'41\', \'777777\', \'77777\', NULL), (\'42\', \'3\', \'4\', NULL), (\'43\', \'33\', \'44\', NULL), (\'44\', \'333\', \'444\', NULL), (\'45\', \'777777\', \'77777\', NULL), (\'46\', \'3\', \'4\', NULL), (\'47\', \'33\', \'44\', NULL), (\'48\', \'333\', \'444\', NULL), (\'49\', \'777777\', \'77777\', NULL), (\'50\', \'3\', \'4\', NULL), (\'51\', \'33\', \'44\', NULL), (\'52\', \'333\', \'444\', NULL), (\'53\', \'777777\', \'77777\', NULL), (\'54\', \'3\', \'4\', NULL), (\'55\', \'33\', \'44\', NULL), (\'56\', \'333\', \'444\', NULL), (\'57\', \'777777\', \'77777\', NULL), (\'58\', \'3\', \'4\', NULL), (\'59\', \'33\', \'44\', NULL), (\'60\', \'333\', \'444\', NULL), (\'61\', \'777777\', \'77777\', NULL), (\'62\', \'3\', \'4\', NULL), (\'63\', \'33\', \'44\', NULL), (\'64\', \'333\', \'444\', NULL), (\'65\', \'777777\', \'77777\', NULL), (\'66\', \'3\', \'4\', NULL), (\'67\', \'33\', \'44\', NULL), (\'68\', \'333\', \'444\', NULL), (\'69\', \'777777\', \'77777\', NULL), (\'70\', \'3\', \'4\', NULL), (\'71\', \'33\', \'44\', NULL), (\'72\', \'333\', \'444\', NULL), (\'73\', \'777777\', \'77777\', NULL), (\'74\', \'3\', \'4\', NULL), (\'75\', \'33\', \'44\', NULL), (\'76\', \'333\', \'444\', NULL), (\'77\', \'777777\', \'77777\', NULL), (\'78\', \'3\', \'4\', NULL), (\'79\', \'33\', \'44\', NULL), (\'80\', \'333\', \'444\', NULL), (\'81\', \'777777\', \'77777\', NULL), (\'82\', \'3\', \'4\', NULL), (\'83\', \'33\', \'44\', NULL), (\'84\', \'333\', \'444\', NULL), (\'85\', \'777777\', \'77777\', NULL), (\'86\', \'3\', \'4\', NULL), (\'87\', \'33\', \'44\', NULL), (\'88\', \'333\', \'444\', NULL), (\'89\', \'777777\', \'77777\', NULL), (\'90\', \'3\', \'4\', NULL), (\'91\', \'33\', \'44\', NULL), (\'92\', \'333\', \'444\', NULL), (\'93\', \'777777\', \'77777\', NULL), (\'94\', \'3\', \'4\', NULL), (\'95\', \'33\', \'44\', NULL), (\'96\', \'333\', \'444\', NULL), (\'97\', \'777777\', \'77777\', NULL), (\'98\', \'3\', \'4\', NULL), (\'99\', \'33\', \'44\', NULL), (\'100\', \'333\', \'444\', NULL), (\'101\', \'777777\', \'77777\', NULL), (\'102\', \'3\', \'4\', NULL), (\'103\', \'33\', \'44\', NULL), (\'104\', \'333\', \'444\', NULL), (\'105\', \'777777\', \'77777\', NULL), (\'106\', \'3\', \'4\', NULL), (\'107\', \'33\', \'44\', NULL), (\'108\', \'333\', \'444\', NULL), (\'109\', \'777777\', \'77777\', NULL), (\'110\', \'3\', \'4\', NULL), (\'111\', \'33\', \'44\', NULL), (\'112\', \'333\', \'444\', NULL), (\'113\', \'777777\', \'77777\', NULL), (\'114\', \'3\', \'4\', NULL), (\'115\', \'33\', \'44\', NULL), (\'116\', \'333\', \'444\', NULL), (\'117\', \'777777\', \'77777\', NULL), (\'118\', \'3\', \'4\', NULL), (\'119\', \'33\', \'44\', NULL), (\'120\', \'333\', \'444\', NULL), (\'121\', \'777777\', \'77777\', NULL), (\'122\', \'3\', \'4\', NULL), (\'123\', \'33\', \'44\', NULL), (\'124\', \'333\', \'444\', NULL), (\'125\', \'777777\', \'77777\', NULL), (\'126\', \'3\', \'4\', NULL), (\'127\', \'33\', \'44\', NULL), (\'128\', \'333\', \'444\', NULL), (\'129\', \'777777\', \'77777\', NULL), (\'130\', \'3\', \'4\', NULL), (\'131\', \'33\', \'44\', NULL), (\'132\', \'333\', \'444\', NULL), (\'133\', \'777777\', \'77777\', NULL), (\'134\', \'3\', \'4\', NULL), (\'135\', \'33\', \'44\', NULL), (\'136\', \'333\', \'444\', NULL), (\'137\', \'777777\', \'77777\', NULL), (\'138\', \'3\', \'4\', NULL), (\'139\', \'33\', \'44\', NULL), (\'140\', \'333\', \'444\', NULL), (\'141\', \'777777\', \'77777\', NULL), (\'142\', \'3\', \'4\', NULL), (\'143\', \'33\', \'44\', NULL), (\'144\', \'333\', \'444\', NULL), (\'145\', \'777777\', \'77777\', NULL), (\'146\', \'3\', \'4\', NULL), (\'147\', \'33\', \'44\', NULL), (\'148\', \'333\', \'444\', NULL), (\'149\', \'777777\', \'77777\', NULL), (\'150\', \'3\', \'4\', NULL), (\'151\', \'33\', \'44\', NULL), (\'152\', \'333\', \'444\', NULL), (\'153\', \'777777\', \'77777\', NULL), (\'154\', \'3\', \'4\', NULL), (\'155\', \'33\', \'44\', NULL), (\'156\', \'333\', \'444\', NULL), (\'157\', \'777777\', \'77777\', NULL), (\'158\', \'3\', \'4\', NULL), (\'159\', \'33\', \'44\', NULL), (\'160\', \'333\', \'444\', NULL), (\'161\', \'777777\', \'77777\', NULL), (\'162\', \'3\', \'4\', NULL), (\'163\', \'33\', \'44\', NULL), (\'164\', \'333\', \'444\', NULL), (\'165\', \'777777\', \'77777\', NULL), (\'166\', \'3\', \'4\', NULL), (\'167\', \'33\', \'44\', NULL), (\'168\', \'333\', \'444\', NULL), (\'169\', \'777777\', \'77777\', NULL), (\'170\', \'3\', \'4\', NULL), (\'171\', \'33\', \'44\', NULL), (\'172\', \'333\', \'444\', NULL), (\'173\', \'777777\', \'77777\', NULL), (\'174\', \'3\', \'4\', NULL), (\'175\', \'33\', \'44\', NULL), (\'176\', \'333\', \'444\', NULL), (\'177\', \'777777\', \'77777\', NULL), (\'178\', \'3\', \'4\', NULL), (\'179\', \'33\', \'44\', NULL), (\'180\', \'333\', \'444\', NULL), (\'181\', \'777777\', \'77777\', NULL), (\'182\', \'3\', \'4\', NULL), (\'183\', \'33\', \'44\', NULL), (\'184\', \'333\', \'444\', NULL), (\'185\', \'777777\', \'77777\', NULL), (\'186\', \'3\', \'4\', NULL), (\'187\', \'33\', \'44\', NULL), (\'188\', \'333\', \'444\', NULL), (\'189\', \'777777\', \'77777\', NULL), (\'190\', \'3\', \'4\', NULL), (\'191\', \'33\', \'44\', NULL), (\'192\', \'333\', \'444\', NULL), (\'193\', \'777777\', \'77777\', NULL), (\'194\', \'3\', \'4\', NULL), (\'195\', \'33\', \'44\', NULL), (\'196\', \'333\', \'444\', NULL), (\'197\', \'777777\', \'77777\', NULL), (\'198\', \'3\', \'4\', NULL), (\'199\', \'33\', \'44\', NULL), (\'200\', \'333\', \'444\', NULL), (\'201\', \'777777\', \'77777\', NULL), (\'202\', \'3\', \'4\', NULL), (\'203\', \'33\', \'44\', NULL), (\'204\', \'333\', \'444\', NULL), (\'205\', \'777777\', \'77777\', NULL), (\'206\', \'3\', \'4\', NULL), (\'207\', \'33\', \'44\', NULL), (\'208\', \'333\', \'444\', NULL), (\'209\', \'777777\', \'77777\', NULL), (\'210\', \'3\', \'4\', NULL), (\'211\', \'33\', \'44\', NULL), (\'212\', \'333\', \'444\', NULL), (\'213\', \'777777\', \'77777\', NULL), (\'214\', \'3\', \'4\', NULL), (\'215\', \'33\', \'44\', NULL), (\'216\', \'333\', \'444\', NULL), (\'217\', \'777777\', \'77777\', NULL), (\'218\', \'3\', \'4\', NULL), (\'219\', \'33\', \'44\', NULL), (\'220\', \'333\', \'444\', NULL), (\'221\', \'777777\', \'77777\', NULL), (\'222\', \'3\', \'4\', NULL), (\'223\', \'33\', \'44\', NULL), (\'224\', \'333\', \'444\', NULL), (\'225\', \'777777\', \'77777\', NULL), (\'226\', \'3\', \'4\', NULL), (\'227\', \'33\', \'44\', NULL), (\'228\', \'333\', \'444\', NULL), (\'229\', \'777777\', \'77777\', NULL), (\'230\', \'3\', \'4\', NULL), (\'231\', \'33\', \'44\', NULL), (\'232\', \'333\', \'444\', NULL), (\'233\', \'777777\', \'77777\', NULL), (\'234\', \'3\', \'4\', NULL), (\'235\', \'33\', \'44\', NULL), (\'236\', \'333\', \'444\', NULL), (\'237\', \'777777\', \'77777\', NULL), (\'238\', \'3\', \'4\', NULL), (\'239\', \'33\', \'44\', NULL), (\'240\', \'333\', \'444\', NULL), (\'241\', \'777777\', \'77777\', NULL), (\'242\', \'3\', \'4\', NULL), (\'243\', \'33\', \'44\', NULL), (\'244\', \'333\', \'444\', NULL), (\'245\', \'777777\', \'77777\', NULL), (\'246\', \'3\', \'4\', NULL), (\'247\', \'33\', \'44\', NULL), (\'248\', \'333\', \'444\', NULL), (\'249\', \'777777\', \'77777\', NULL), (\'250\', \'3\', \'4\', NULL), (\'251\', \'33\', \'44\', NULL), (\'252\', \'333\', \'444\', NULL), (\'253\', \'777777\', \'77777\', NULL), (\'254\', \'3\', \'4\', NULL), (\'255\', \'33\', \'44\', NULL), (\'256\', \'333\', \'444\', NULL), (\'257\', \'777777\', \'77777\', NULL), (\'258\', \'3\', \'4\', NULL), (\'259\', \'33\', \'44\', NULL), (\'260\', \'333\', \'444\', NULL), (\'261\', \'777777\', \'77777\', NULL), (\'262\', \'3\', \'4\', NULL), (\'263\', \'33\', \'44\', NULL), (\'264\', \'333\', \'444\', NULL), (\'265\', \'777777\', \'77777\', NULL), (\'266\', \'3\', \'4\', NULL), (\'267\', \'33\', \'44\', NULL), (\'268\', \'333\', \'444\', NULL), (\'269\', \'777777\', \'77777\', NULL), (\'270\', \'3\', \'4\', NULL), (\'271\', \'33\', \'44\', NULL), (\'272\', \'333\', \'444\', NULL), (\'273\', \'777777\', \'77777\', NULL), (\'274\', \'3\', \'4\', NULL), (\'275\', \'33\', \'44\', NULL), (\'276\', \'333\', \'444\', NULL), (\'277\', \'777777\', \'77777\', NULL), (\'278\', \'3\', \'4\', NULL), (\'279\', \'33\', \'44\', NULL), (\'280\', \'333\', \'444\', NULL), (\'281\', \'777777\', \'77777\', NULL), (\'282\', \'3\', \'4\', NULL), (\'283\', \'33\', \'44\', NULL), (\'284\', \'333\', \'444\', NULL), (\'285\', \'777777\', \'77777\', NULL), (\'286\', \'3\', \'4\', NULL), (\'287\', \'33\', \'44\', NULL), (\'288\', \'333\', \'444\', NULL), (\'289\', \'777777\', \'77777\', NULL), (\'290\', \'3\', \'4\', NULL), (\'291\', \'33\', \'44\', NULL), (\'292\', \'333\', \'444\', NULL), (\'293\', \'777777\', \'77777\', NULL), (\'294\', \'3\', \'4\', NULL), (\'295\', \'33\', \'44\', NULL), (\'296\', \'333\', \'444\', NULL), (\'297\', \'777777\', \'77777\', NULL), (\'298\', \'3\', \'4\', NULL), (\'299\', \'33\', \'44\', NULL), (\'300\', \'333\', \'444\', NULL), (\'301\', \'777777\', \'77777\', NULL), (\'302\', \'3\', \'4\', NULL), (\'303\', \'33\', \'44\', NULL), (\'304\', \'333\', \'444\', NULL), (\'305\', \'777777\', \'77777\', NULL), (\'306\', \'3\', \'4\', NULL), (\'307\', \'33\', \'44\', NULL), (\'308\', \'333\', \'444\', NULL), (\'309\', \'777777\', \'77777\', NULL), (\'310\', \'3\', \'4\', NULL), (\'311\', \'33\', \'44\', NULL), (\'312\', \'333\', \'444\', NULL), (\'313\', \'777777\', \'77777\', NULL), (\'314\', \'3\', \'4\', NULL), (\'315\', \'33\', \'44\', NULL), (\'316\', \'333\', \'444\', NULL), (\'317\', \'777777\', \'77777\', NULL), (\'318\', \'3\', \'4\', NULL), (\'319\', \'33\', \'44\', NULL), (\'320\', \'333\', \'444\', NULL), (\'321\', \'777777\', \'77777\', NULL), (\'322\', \'3\', \'4\', NULL), (\'323\', \'33\', \'44\', NULL), (\'324\', \'333\', \'444\', NULL), (\'325\', \'777777\', \'77777\', NULL), (\'326\', \'3\', \'4\', NULL), (\'327\', \'33\', \'44\', NULL), (\'328\', \'333\', \'444\', NULL), (\'329\', \'777777\', \'77777\', NULL), (\'330\', \'3\', \'4\', NULL), (\'331\', \'33\', \'44\', NULL), (\'332\', \'333\', \'444\', NULL), (\'333\', \'777777\', \'77777\', NULL), (\'334\', \'3\', \'4\', NULL), (\'335\', \'33\', \'44\', NULL), (\'336\', \'333\', \'444\', NULL), (\'337\', \'777777\', \'77777\', NULL), (\'338\', \'3\', \'4\', NULL), (\'339\', \'33\', \'44\', NULL), (\'340\', \'333\', \'444\', NULL), (\'341\', \'777777\', \'77777\', NULL), (\'342\', \'3\', \'4\', NULL), (\'343\', \'33\', \'44\', NULL), (\'344\', \'333\', \'444\', NULL), (\'345\', \'777777\', \'77777\', NULL), (\'346\', \'3\', \'4\', NULL), (\'347\', \'33\', \'44\', NULL), (\'348\', \'333\', \'444\', NULL), (\'349\', \'777777\', \'77777\', NULL), (\'350\', \'3\', \'4\', NULL), (\'351\', \'33\', \'44\', NULL), (\'352\', \'333\', \'444\', NULL), (\'353\', \'777777\', \'77777\', NULL), (\'354\', \'3\', \'4\', NULL), (\'355\', \'33\', \'44\', NULL), (\'356\', \'333\', \'444\', NULL), (\'357\', \'777777\', \'77777\', NULL), (\'358\', \'3\', \'4\', NULL), (\'359\', \'33\', \'44\', NULL), (\'360\', \'333\', \'444\', NULL), (\'361\', \'777777\', \'77777\', NULL), (\'362\', \'3\', \'4\', NULL), (\'363\', \'33\', \'44\', NULL), (\'364\', \'333\', \'444\', NULL), (\'365\', \'777777\', \'77777\', NULL), (\'366\', \'3\', \'4\', NULL), (\'367\', \'33\', \'44\', NULL), (\'368\', \'333\', \'444\', NULL), (\'369\', \'777777\', \'77777\', NULL), (\'370\', \'3\', \'4\', NULL), (\'371\', \'33\', \'44\', NULL), (\'372\', \'333\', \'444\', NULL), (\'373\', \'777777\', \'77777\', NULL), (\'374\', \'3\', \'4\', NULL), (\'375\', \'33\', \'44\', NULL), (\'376\', \'333\', \'444\', NULL), (\'377\', \'777777\', \'77777\', NULL), (\'378\', \'3\', \'4\', NULL), (\'379\', \'33\', \'44\', NULL), (\'380\', \'333\', \'444\', NULL), (\'381\', \'777777\', \'77777\', NULL), (\'382\', \'3\', \'4\', NULL), (\'383\', \'33\', \'44\', NULL), (\'384\', \'333\', \'444\', NULL), (\'385\', \'777777\', \'77777\', NULL), (\'386\', \'3\', \'4\', NULL), (\'387\', \'33\', \'44\', NULL), (\'388\', \'333\', \'444\', NULL), (\'389\', \'777777\', \'77777\', NULL), (\'390\', \'3\', \'4\', NULL), (\'391\', \'33\', \'44\', NULL), (\'392\', \'333\', \'444\', NULL), (\'393\', \'777777\', \'77777\', NULL), (\'394\', \'3\', \'4\', NULL), (\'395\', \'33\', \'44\', NULL), (\'396\', \'333\', \'444\', NULL), (\'397\', \'777777\', \'77777\', NULL), (\'398\', \'3\', \'4\', NULL), (\'399\', \'33\', \'44\', NULL), (\'400\', \'333\', \'444\', NULL), (\'401\', \'777777\', \'77777\', NULL), (\'402\', \'3\', \'4\', NULL), (\'403\', \'33\', \'44\', NULL), (\'404\', \'333\', \'444\', NULL), (\'405\', \'777777\', \'77777\', NULL), (\'406\', \'3\', \'4\', NULL), (\'407\', \'33\', \'44\', NULL), (\'408\', \'333\', \'444\', NULL), (\'409\', \'777777\', \'77777\', NULL), (\'410\', \'3\', \'4\', NULL), (\'411\', \'33\', \'44\', NULL), (\'412\', \'333\', \'444\', NULL), (\'413\', \'777777\', \'77777\', NULL), (\'414\', \'3\', \'4\', NULL), (\'415\', \'33\', \'44\', NULL), (\'416\', \'333\', \'444\', NULL), (\'417\', \'777777\', \'77777\', NULL), (\'418\', \'3\', \'4\', NULL), (\'419\', \'33\', \'44\', NULL), (\'420\', \'333\', \'444\', NULL), (\'421\', \'777777\', \'77777\', NULL), (\'422\', \'3\', \'4\', NULL), (\'423\', \'33\', \'44\', NULL), (\'424\', \'333\', \'444\', NULL), (\'425\', \'777777\', \'77777\', NULL), (\'426\', \'3\', \'4\', NULL), (\'427\', \'33\', \'44\', NULL), (\'428\', \'333\', \'444\', NULL), (\'429\', \'777777\', \'77777\', NULL), (\'430\', \'3\', \'4\', NULL), (\'431\', \'33\', \'44\', NULL), (\'432\', \'333\', \'444\', NULL), (\'433\', \'777777\', \'77777\', NULL), (\'434\', \'3\', \'4\', NULL), (\'435\', \'33\', \'44\', NULL), (\'436\', \'333\', \'444\', NULL), (\'437\', \'777777\', \'77777\', NULL), (\'438\', \'3\', \'4\', NULL), (\'439\', \'33\', \'44\', NULL), (\'440\', \'333\', \'444\', NULL), (\'441\', \'777777\', \'77777\', NULL), (\'442\', \'3\', \'4\', NULL), (\'443\', \'33\', \'44\', NULL), (\'444\', \'333\', \'444\', NULL), (\'445\', \'777777\', \'77777\', NULL), (\'446\', \'7\', \'7\', NULL), (\'447\', \'777\', \'777\', NULL), (\'448\', \'7\', \'7\', NULL), (\'449\', \'777\', \'777\', NULL), (\'450\', \'7\', \'7\', NULL), (\'451\', \'777\', \'777\', NULL), (\'452\', \'7\', \'7\', NULL), (\'453\', \'777\', \'777\', NULL), (\'454\', \'7\', \'7\', NULL), (\'455\', \'777\', \'777\', NULL), (\'456\', \'7\', \'7\', NULL), (\'457\', \'777\', \'777\', NULL), (\'458\', \'7\', \'7\', NULL), (\'459\', \'777\', \'777\', NULL), (\'460\', \'7\', \'7\', NULL), (\'461\', \'777\', \'777\', NULL), (\'462\', \'7\', \'7\', NULL), (\'463\', \'777\', \'777\', NULL), (\'464\', \'7\', \'7\', NULL), (\'465\', \'777\', \'777\', NULL)',
  2 => 'INSERT INTO __posts3 VALUES(\'9\', \'54\', \'35435\', \'4\'), (\'10\', \'43\', \'5435435\', \'3\'), (\'11\', \'54\', \'35435\', \'4\')',
  3 => 'INSERT INTO __users VALUES(\'1\', \'slavamnem\', \'1234\', \'Slava Zelinskiy\', \'2018-12-18\'), (\'2\', \'vladik123\', \'1234\', \'Vlad Butnaru\', \'2018-12-18\'), (\'3\', \'dimka8\', \'333555\', \'Dima Hutor\', \'2018-12-03\'), (\'4\', \'oleg\', \'1234\', \'Oleg Petrov\', \'2018-12-12\'), (\'5\', \'nasta\', \'1234\', \'Nasta Ivanova\', \'2018-12-12\')',
);
    public static $createTablesSqls = array (
  0 => 'CREATE TABLE __likes (
id int(11) auto_increment,
maker_id int(11) DEFAULT NULL,
receiver_id int(11) DEFAULT NULL,
PRIMARY KEY (id),
FOREIGN KEY (maker_id) REFERENCES __users(id),
FOREIGN KEY (receiver_id) REFERENCES __users(id)
)',
  1 => 'CREATE TABLE __posts (
id int(11) auto_increment,
title varchar(255) DEFAULT NULL,
text text DEFAULT NULL,
author int(11) DEFAULT NULL,
PRIMARY KEY (id),
FOREIGN KEY (author) REFERENCES __users(id)
)',
  2 => 'CREATE TABLE __posts3 (
id int(11) auto_increment,
title varchar(255) DEFAULT NULL,
text text DEFAULT NULL,
author int(11) DEFAULT NULL,
PRIMARY KEY (id),
FOREIGN KEY (author) REFERENCES __users(id)
)',
  3 => 'CREATE TABLE __users (
id int(11) auto_increment,
login varchar(255),
password varchar(255),
full_name varchar(255),
date_add date,
PRIMARY KEY (id)
)',
  4 => 'CREATE TABLE requests (
id int(11) auto_increment,
request text DEFAULT NULL,
created_at datetime DEFAULT NULL,
PRIMARY KEY (id)
)',
);

    public static function restore()
    {
        self::$pdo = PdoHelper::getPdo();
        self::$pdo->beginTransaction();

        try {
            self::tryToExecute(self::$createTablesSqls);
            self::tryToExecute(self::$insertDataSqls);
            self::$pdo->commit();
        } catch (\Exception $e) {
            self::$pdo->rollBack();
        }
    }

    private static function tryToExecute($queries)
    {
        $doneQueries = [];

        $errorsAmount = 0;
        while (count($doneQueries) < count($queries)){
            foreach ($queries as $query) {
                if ($errorsAmount > self::TRIES_LIMIT){
                    throw new \Exception();
                } elseif (!in_array($query, $doneQueries)) {
                    try {
                        dump($query);
                        $stmp = self::$pdo->prepare($query);
                        $stmp->execute();
                        array_push($doneQueries, $query);
                    } catch (\Exception $exception) {
                        dump("ups(");
                        $errorsAmount++;
                        continue;
                    }
                }
            }
        }
    }
}