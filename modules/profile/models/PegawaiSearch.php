<?php

namespace app\modules\profile\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\profile\models\Pegawai;

/**
 * PegawaiSearch represents the model behind the search form of `app\modules\profile\models\Pegawai`.
 */
class PegawaiSearch extends Pegawai
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pegawai', 'user_id', 'agama_id', 'bank_id', 'nomor_rekening', 'status', 'created_by', 'updated_by'], 'integer'],
            [['nip_pegawai', 'nama_pegawai', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'status_pernikahan', 'golongan_darah', 'email', 'alamat_pegawai', 'npwp', 'nik', 'nomor_telp', 'nomor_hp', 'foto', 'keterangan', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pegawai::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_pegawai' => $this->id_pegawai,
            'user_id' => $this->user_id,
            'tanggal_lahir' => $this->tanggal_lahir,
            'agama_id' => $this->agama_id,
            'bank_id' => $this->bank_id,
            'nomor_rekening' => $this->nomor_rekening,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nip_pegawai', $this->nip_pegawai])
            ->andFilterWhere(['like', 'nama_pegawai', $this->nama_pegawai])
            ->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'jenis_kelamin', $this->jenis_kelamin])
            ->andFilterWhere(['like', 'status_pernikahan', $this->status_pernikahan])
            ->andFilterWhere(['like', 'golongan_darah', $this->golongan_darah])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'alamat_pegawai', $this->alamat_pegawai])
            ->andFilterWhere(['like', 'npwp', $this->npwp])
            ->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'nomor_telp', $this->nomor_telp])
            ->andFilterWhere(['like', 'nomor_hp', $this->nomor_hp])
            ->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
