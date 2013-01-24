<?php
/**
 * +-----------------------------------------------------------------------+
 * | Copyright (c) 2010, David Coallier & echolibre ltd                    |
 * | All rights reserved.                                                  |
 * |                                                                       |
 * | Redistribution and use in source and binary forms, with or without    |
 * | modification, are permitted provided that the following conditions    |
 * | are met:                                                              |
 * |                                                                       |
 * | o Redistributions of source code must retain the above copyright      |
 * |   notice, this list of conditions and the following disclaimer.       |
 * | o Redistributions in binary form must reproduce the above copyright   |
 * |   notice, this list of conditions and the following disclaimer in the |
 * |   documentation and/or other materials provided with the distribution.|
 * | o The names of the authors may not be used to endorse or promote      |
 * |   products derived from this software without specific prior written  |
 * |   permission.                                                         |
 * |                                                                       |
 * | THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS   |
 * | "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT     |
 * | LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR |
 * | A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT  |
 * | OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, |
 * | SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT      |
 * | LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, |
 * | DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY |
 * | THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT   |
 * | (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE |
 * | OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.  |
 * |                                                                       |
 * +-----------------------------------------------------------------------+
 * | Author: David Coallier <david@echolibre.com>                          |
 * +-----------------------------------------------------------------------+
 *
 * PHP version 5
 *
 * @category  Services
 * @package   Services_Capsule
 * @author    David Coallier <david@echolibre.com>
 * @copyright echolibre ltd. 2009-2010
 * @license   http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @link      http://github.com/davidcoallier/Services_Capsule
 * @version   GIT: $Id$
 */

/**
 * Services_Capsule
 *
 * @category Services
 * @package  Services_Capsule
 * @author   David Coallier <david@echolibre.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @link     http://github.com/davidcoallier/Services_Capsule
 * @link     http://capsulecrm.com/help/page/javelin_api_party
 * @version  Release: @package_version@
 */
class Services_Capsule_Party_History extends Services_Capsule_Common
{
    /**
     * Get party history
     *
     * History of notes and emails for party records. 
     *
     * @link    /api/party/{id}/history
     * @throws Services_Capsule_RuntimeException
     *
     * @param  double       $partyId The party to retrieve the history from.
     * @return stdClass     A stdClass object containing the information from
     *                      the json-decoded response from the server.
     */
    public function getAll($partyId)
    {
        $url      = '/' . (double)$partyId . '/history';
        $response = $this->sendRequest($url);
        
        return $this->parseResponse($response);
    }
    
    /**
     * Add an history note to a party
     *
     * This method is used to add an history note to a party.
     *
     * @link /api/party/{party-id}/history
     * @throws Services_Capsule_RuntimeException
     *
     * @param  double       $partyId       The party to create the note on.
     * @param  string       $note          The note to add to history.
     *
     * @return mixed bool|stdClass         A stdClass object containing the information from
     *                                     the json-decoded response from the server.
     */
    public function addNote($partyId, $note)
    {
        $url = '/' . (double)$partyId . '/history';

        $note = array(
            'historyItem' => array(
                'note' => $note
            ),
        );

        $response = $this->sendRequest($url, HTTP_Request2::METHOD_POST, $note);
        return $this->parseResponse($response);
    }
    
    /**
     * Add an history note of a party
     *
     * This method is used to update an history note to a party.
     *
     * @link /api/party/{party-id}/history/{history-id}
     * @throws Services_Capsule_RuntimeException
     *
     * @param  double       $partyId The party to create the tags on.
     * @param  double       $historyId     The note id to update.
     * @param  string       $note          The note to add to history.
     *
     * @return mixed bool|stdClass         A stdClass object containing the information from
     *                                     the json-decoded response from the server.
     */
    public function updateNote($partyId, $historyId, $note)
    {
        $url = '/' . (double)$partyId . '/history/' . (double)$historyId;

        $note = array(
            'historyItem' => array(
                'note' => $note
            ),
        );
        
        $response = $this->sendRequest($url, HTTP_Request2::METHOD_PUT, $note);
        return $this->parseResponse($response);
    }
    
    /**
     * Delete an history note from a party
     *
     * This method is used to delete an history note from a party.
     *
     * @link /api/party/{party-id}/history/{history-id}
     * @throws Services_Capsule_RuntimeException
     *
     * @param  double       $partyId       The party to delete the note from.
     * @param  double       $historyId     The note id to delete.
     *
     * @return mixed bool|stdClass         A stdClass object containing the information from
     *                                     the json-decoded response from the server.
     */
    public function deleteNote($partyId, $historyId)
    {
        $url = '/' . (double)$partyId . '/history/' . (double)$historyId;
        
        $response = $this->sendRequest($url, HTTP_Request2::METHOD_DELETE);
        return $this->parseResponse($response);
    }
}